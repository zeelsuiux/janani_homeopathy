# Homeopathy Clinic PHP Website + Doctor Panel

A PHP website inspired by the information architecture of the supplied reference clinic site, customized for the supplied green brand palette and logo.

## Important
- **No MySQL / SQL is used.** Records are stored as separate JSON files inside the `database/` folder.
- Deleted records are automatically archived in separate files under `database/deleted/` before they are removed from their collection file; each backup record includes its `deleted_at` date and time.
- Uploaded blog/gallery images are stored under `uploads/` and their paths are stored in the relevant `database/*.json` file.
- PHP needs permission to write the `database/` folder and the `uploads/` folder.
- Change the admin username/password from **Admin → Settings** before production.
- The master admin can create sub-admin users and review timestamped activity from **Admin Users** and **Activity Log**.

## Main website
- Home
- About
- Treatments
- Gallery
- Blog + blog detail
- Contact inquiry form
- Public appointment booking

## Doctor/Admin panel
Open `/admin/login.php`
- Dashboard
- Patient create/edit/delete
- Auto age from DOB
- Patient number generation (`PAT-000001`)
- Appointment number generation (`APT-000001`)
- Appointment management
- Month / Week / Day calendar
- Appointment completion with medicine, instructions, amount paid and next appointment date
- Next appointment appears on calendar
- Patient history with total paid and total appointment count
- Inquiry panel + convert inquiry to patient
- Blog upload with image and bold/italic/underline editor
- Gallery upload and visitor gallery
- Website settings and color variables

## Default admin
- Username: `admin`
- Password: `admin123`

Change these immediately after setup.


Inquiry Flow: Contact Us submissions and Book Appointment requests are stored in the admin Inquiries panel. Appointment requests retain requested date/time and patient details. Converting an appointment request creates the patient and scheduled appointment automatically.
