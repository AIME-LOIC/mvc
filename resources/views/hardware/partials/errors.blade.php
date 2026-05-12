@if ($errors->any())
    <div style="padding: 12px; border: 1px solid #ef4444; background: #fef2f2; margin: 12px 0;">
        <strong>Fix the following:</strong>
        <ul style="margin: 8px 0 0; padding-left: 18px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

