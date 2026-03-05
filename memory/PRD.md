# BIM Digital Website - PRD

## Original Problem Statement
Convert PHP-based website for BIM Digital to HTML with fixes:
- Header not showing properly (mobile menu items appearing outside drawer)
- Logo showing issue - keep original design without CSS modifications
- Remove logo from footer
- Make all device responsive
- Make contact form work with SMTP

## Architecture
- **Technology**: Static HTML + FastAPI Backend for contact form
- **Files Structure**:
  - `index.html` - Home page
  - `about.html` - About page
  - `services.html` - Services page
  - `contact.html` - Contact page with working form
  - `assets/css/style.css` - Main stylesheet
  - `/logo.jpg` - Logo image (in public folder)
  - `backend/server.py` - FastAPI server for contact form

## What's Been Implemented (Jan 2026)

### Conversion & Fixes Completed:
1. **PHP to HTML Conversion**: 
   - All 4 pages converted from PHP to static HTML
   - Dynamic year in footer using JavaScript

2. **Contact Form Working with SMTP**:
   - Backend API at `/api/contact`
   - SMTP: Google Workspace (smtp.gmail.com:587 TLS)
   - Sends notification email to akhileshs@bimdigital.in
   - Sends auto-reply to user

3. **Logo Updated**:
   - Path changed to `/logo.jpg`
   - All pages updated

4. **Email Updated**:
   - All emails changed to akhileshs@bimdigital.in

5. **Footer Logo Removed**: 
   - Replaced with text heading "BIM Digital"

6. **Mobile Navigation Fixed**:
   - CSS properly hides drawer until opened

## SMTP Configuration:
- Host: smtp.gmail.com
- Port: 587
- Encryption: TLS
- Username: akhileshs@bimdigital.in

## Files:
- `/app/index.html`, `/app/about.html`, `/app/services.html`, `/app/contact.html`
- `/app/backend/server.py` - Contact form API
- `/app/assets/css/style.css`

## Next Action Items:
- Upload logo.jpg to public folder
- Deploy to hosting
