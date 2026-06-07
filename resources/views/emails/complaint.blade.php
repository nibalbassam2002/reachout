<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; padding: 30px; color: #333;">

    <h2 style="color: #1a3c6e;">New Complaint Submitted</h2>
    <hr>
    <p><strong>Contact Info:</strong> {{ $complaint->contact_info }}</p>
    <p><strong>Type of Concern:</strong> {{ $complaint->type_of_concern }}</p>
    <p><strong>Details:</strong></p>
    <p style="background:#f4f4f4; padding:15px; border-radius:6px;">{{ $complaint->details }}</p>
    <p><strong>Submitted At:</strong> {{ $complaint->created_at }}</p>
    <hr>
    <p style="color:#888; font-size:12px;">Mental Health Frontline — Confidential</p>

</body>
</html>