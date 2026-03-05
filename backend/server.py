from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from fastapi.staticfiles import StaticFiles
from fastapi.responses import FileResponse
from pydantic import BaseModel, EmailStr
import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import os

app = FastAPI(title="BIM Digital Contact API")

# CORS middleware
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# SMTP Configuration
SMTP_HOST = "smtp.gmail.com"
SMTP_PORT = 587
SMTP_USER = "akhileshs@bimdigital.in"
SMTP_PASS = "mons wfgf xuxk emko"
MAIL_TO = "akhileshs@bimdigital.in"

class ContactForm(BaseModel):
    name: str
    email: EmailStr
    phone: str = ""
    company: str = ""
    service: str = ""
    message: str

@app.get("/api/health")
async def health_check():
    return {"status": "healthy", "service": "BIM Digital Contact API"}

@app.post("/api/contact")
async def send_contact(form: ContactForm):
    try:
        # Map service codes to labels
        service_labels = {
            "bi": "Business Intelligence & Analytics",
            "marketing": "Strategic Marketing & Brand",
            "digital": "Digital Performance & Demand Generation",
            "media": "Media Intelligence & Communications",
            "all": "Full Growth Partnership",
            "": "Not specified"
        }
        service_label = service_labels.get(form.service, form.service or "Not specified")
        
        # Create HTML email body
        html_body = f"""
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <style>
    body {{ font-family: 'Segoe UI', Arial, sans-serif; background: #f7fbfe; margin: 0; padding: 0; }}
    .wrap {{ max-width: 600px; margin: 30px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.07); }}
    .hd {{ background: #00AEEF; padding: 32px 36px; color: #fff; }}
    .hd h2 {{ margin: 0; font-size: 1.4rem; font-weight: 800; }}
    .hd p {{ margin: 4px 0 0; font-size: 0.9rem; opacity: .85; }}
    .bd {{ padding: 32px 36px; }}
    .row {{ margin-bottom: 18px; }}
    .lbl {{ font-size: 0.72rem; text-transform: uppercase; letter-spacing: .1em; color: #8a94a6; font-weight: 700; margin-bottom: 4px; }}
    .val {{ font-size: 0.95rem; color: #1c2333; font-weight: 500; }}
    .msg {{ background: #f7fbfe; border: 1px solid #e8eff5; border-radius: 8px; padding: 16px; color: #5a6478; font-size: 0.95rem; line-height: 1.7; white-space: pre-wrap; }}
    .ft {{ background: #f7fbfe; padding: 20px 36px; text-align: center; font-size: 0.8rem; color: #8a94a6; border-top: 1px solid #e8eff5; }}
  </style>
</head>
<body>
<div class="wrap">
  <div class="hd">
    <h2>📞 New Contact Form Submission</h2>
    <p>BIM Digital Website</p>
  </div>
  <div class="bd">
    <div class="row"><div class="lbl">Full Name</div><div class="val">{form.name}</div></div>
    <div class="row"><div class="lbl">Email Address</div><div class="val"><a href="mailto:{form.email}">{form.email}</a></div></div>
    <div class="row"><div class="lbl">Phone</div><div class="val">{form.phone or 'Not provided'}</div></div>
    <div class="row"><div class="lbl">Company</div><div class="val">{form.company or 'Not provided'}</div></div>
    <div class="row"><div class="lbl">Service Interest</div><div class="val">{service_label}</div></div>
    <div class="row">
      <div class="lbl">Message</div>
      <div class="msg">{form.message}</div>
    </div>
  </div>
  <div class="ft">Sent from BIM Digital Website</div>
</div>
</body>
</html>
"""

        # Create auto-reply email
        auto_reply_html = f"""
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"/>
<style>
  body{{font-family:'Segoe UI',Arial,sans-serif;background:#f7fbfe;margin:0;padding:0;}}
  .wrap{{max-width:600px;margin:30px auto;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.07);}}
  .hd{{background:#00AEEF;padding:32px 36px;color:#fff;}}
  .hd h2{{margin:0;font-size:1.4rem;font-weight:800;}}
  .bd{{padding:32px 36px;color:#5a6478;line-height:1.8;font-size:.95rem;}}
  .bd h3{{color:#1c2333;font-size:1.1rem;margin-bottom:1rem;}}
  .btn{{display:inline-block;background:#00AEEF;color:#fff;padding:12px 28px;border-radius:8px;text-decoration:none;font-weight:700;margin-top:1.5rem;}}
  .ft{{background:#f7fbfe;padding:20px 36px;text-align:center;font-size:.8rem;color:#8a94a6;border-top:1px solid #e8eff5;}}
</style>
</head>
<body>
<div class="wrap">
  <div class="hd"><h2>Thank you, {form.name}!</h2></div>
  <div class="bd">
    <h3>We've received your message.</h3>
    <p>Our team at BIM Digital will review your enquiry and get back to you within <strong>24–48 business hours</strong>.</p>
    <p>In the meantime, feel free to explore our services or reach us directly:</p>
    <p>📞 <strong>+91 98711 97779</strong><br>
       📧 <strong>akhileshs@bimdigital.in</strong></p>
    <a href="https://bimdigital.in" class="btn">Visit BIM Digital</a>
  </div>
  <div class="ft">© BIM Digital (Business Intelligence Media) | bimdigital.in</div>
</div>
</body>
</html>
"""

        # Send email to admin
        msg = MIMEMultipart('alternative')
        msg['Subject'] = f"New Enquiry from {form.name} — BIM Digital Website"
        msg['From'] = SMTP_USER
        msg['To'] = MAIL_TO
        msg.attach(MIMEText(html_body, 'html'))

        # Connect and send
        with smtplib.SMTP(SMTP_HOST, SMTP_PORT) as server:
            server.starttls()
            server.login(SMTP_USER, SMTP_PASS)
            server.sendmail(SMTP_USER, MAIL_TO, msg.as_string())
            
            # Send auto-reply to user
            auto_reply = MIMEMultipart('alternative')
            auto_reply['Subject'] = "Thank you for contacting BIM Digital"
            auto_reply['From'] = SMTP_USER
            auto_reply['To'] = form.email
            auto_reply.attach(MIMEText(auto_reply_html, 'html'))
            server.sendmail(SMTP_USER, form.email, auto_reply.as_string())

        return {"success": True, "message": "Message sent successfully"}
    
    except smtplib.SMTPAuthenticationError:
        raise HTTPException(status_code=500, detail="Email authentication failed")
    except smtplib.SMTPException as e:
        raise HTTPException(status_code=500, detail=f"Failed to send email: {str(e)}")
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"An error occurred: {str(e)}")

# Serve static files from root directory
app.mount("/assets", StaticFiles(directory="/app/assets"), name="assets")

# Serve HTML files
@app.get("/")
async def serve_index():
    return FileResponse("/app/index.html")

@app.get("/{filename}.html")
async def serve_html(filename: str):
    filepath = f"/app/{filename}.html"
    if os.path.exists(filepath):
        return FileResponse(filepath)
    raise HTTPException(status_code=404, detail="Page not found")

@app.get("/logo.jpg")
async def serve_logo():
    if os.path.exists("/app/logo.jpg"):
        return FileResponse("/app/logo.jpg")
    raise HTTPException(status_code=404, detail="Logo not found")
