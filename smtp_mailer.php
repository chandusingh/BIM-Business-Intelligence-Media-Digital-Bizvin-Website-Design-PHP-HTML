<?php
/**
 * BIM Digital — Lightweight SMTP Mailer
 * Works with SSL/TLS on port 465 — no PHPMailer dependency needed
 */
class SmtpMailer {
    private string $host;
    private int    $port;
    private string $user;
    private string $pass;
    private string $from;
    private string $fromName;
    private        $socket = null;
    public  string $lastError = '';

    public function __construct(
        string $host,
        int    $port,
        string $user,
        string $pass,
        string $from     = '',
        string $fromName = ''
    ) {
        $this->host     = $host;
        $this->port     = $port;
        $this->user     = $user;
        $this->pass     = $pass;
        $this->from     = $from     ?: $user;
        $this->fromName = $fromName ?: $user;
    }

    /**
     * Send an email. Returns true on success, false on failure.
     */
    public function send(
        string $toEmail,
        string $toName,
        string $subject,
        string $htmlBody,
        string $textBody = ''
    ): bool {
        try {
            $this->connect();
            $this->ehlo();
            $this->authenticate();
            $this->sendCommand("MAIL FROM:<{$this->from}>", 250);
            $this->sendCommand("RCPT TO:<{$toEmail}>", 250);
            $this->sendCommand("DATA", 354);

            $boundary = '=_BIM_' . md5(uniqid('', true));
            $headers  = $this->buildHeaders($toEmail, $toName, $subject, $boundary);
            $body     = $this->buildBody($htmlBody, $textBody, $boundary);
            $message  = $headers . "\r\n" . $body . "\r\n.\r\n";

            $this->write($message);
            $this->readResponse(250);
            $this->sendCommand("QUIT", 221);
            $this->closeSocket();
            return true;
        } catch (\Exception $e) {
            $this->lastError = $e->getMessage();
            $this->closeSocket();
            return false;
        }
    }

    /* ── Private helpers ── */

    private function connect(): void {
        // Port 465 = implicit SSL (ssl://), port 587 = STARTTLS (tcp://)
        $wrapper = ($this->port === 465) ? 'ssl' : 'tcp';
        $ctx = stream_context_create([
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ]
        ]);
        $errno = $errstr = '';
        $this->socket = @stream_socket_client(
            "{$wrapper}://{$this->host}:{$this->port}",
            $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $ctx
        );
        if (!$this->socket) {
            throw new \Exception("Cannot connect to SMTP {$this->host}:{$this->port} — {$errstr}");
        }
        stream_set_timeout($this->socket, 30);
        $this->readResponse(220);
    }

    private function ehlo(): void {
        $domain = gethostname() ?: 'bimdigital.in';
        $this->sendCommand("EHLO {$domain}", 250);
    }

    private function authenticate(): void {
        $this->sendCommand("AUTH LOGIN", 334);
        $this->sendCommand(base64_encode($this->user), 334);
        $this->sendCommand(base64_encode($this->pass), 235);
    }

    private function buildHeaders(
        string $toEmail, string $toName,
        string $subject, string $boundary
    ): string {
        $date    = date('r');
        $msgId   = '<' . uniqid('bim', true) . '@bimdigital.in>';
        $toField = $toName ? "\"{$toName}\" <{$toEmail}>" : $toEmail;
        $from    = $this->fromName
                 ? "\"{$this->fromName}\" <{$this->from}>"
                 : $this->from;

        return implode("\r\n", [
            "Date: {$date}",
            "From: {$from}",
            "To: {$toField}",
            "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=",
            "Message-ID: {$msgId}",
            "MIME-Version: 1.0",
            "Content-Type: multipart/alternative; boundary=\"{$boundary}\"",
            "X-Mailer: BIM-Digital-Mailer/1.0",
        ]);
    }

    private function buildBody(string $html, string $text, string $boundary): string {
        if (!$text) {
            $text = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $html));
        }
        return implode("\r\n", [
            "--{$boundary}",
            "Content-Type: text/plain; charset=UTF-8",
            "Content-Transfer-Encoding: base64",
            "",
            chunk_split(base64_encode($text)),
            "--{$boundary}",
            "Content-Type: text/html; charset=UTF-8",
            "Content-Transfer-Encoding: base64",
            "",
            chunk_split(base64_encode($html)),
            "--{$boundary}--",
        ]);
    }

    private function sendCommand(string $cmd, int $expectedCode): string {
        $this->write($cmd . "\r\n");
        return $this->readResponse($expectedCode);
    }

    private function write(string $data): void {
        if (!$this->socket) throw new \Exception("No SMTP socket");
        fwrite($this->socket, $data);
    }

    private function readResponse(int $expectedCode): string {
        $response = '';
        while ($line = fgets($this->socket, 512)) {
            $response .= $line;
            if (substr($line, 3, 1) === ' ') break; // last line of multi-line response
        }
        $code = (int) substr($response, 0, 3);
        if ($code !== $expectedCode) {
            throw new \Exception("SMTP error {$code} (expected {$expectedCode}): " . trim($response));
        }
        return $response;
    }

    private function closeSocket(): void {
        if ($this->socket) { fclose($this->socket); $this->socket = null; }
    }
}
