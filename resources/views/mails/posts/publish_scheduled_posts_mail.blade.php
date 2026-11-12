<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <title>@lang('Posts Published')</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color:#111827;">

{{-- Önizleme metni (gelen kutusunda görünen kısa özet) --}}
<div style="display:none; max-height:0; overflow:hidden; opacity:0; color:transparent;">
    @lang('Posts for date :scheduledDate have been published.', ['scheduledDate' => $scheduledDate])
</div>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3f4f6; padding:32px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:560px; background-color:#ffffff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">

                {{-- Üst şerit --}}
                <tr>
                    <td style="height:6px; line-height:6px; font-size:0; background-color:#16a34a;">&nbsp;</td>
                </tr>

                {{-- Başlık --}}
                <tr>
                    <td style="padding:28px 32px 8px 32px;">
                        <h1 style="margin:0; font-size:22px; line-height:28px; font-weight:700; color:#111827;">
                            @lang('Hello Admin')
                        </h1>
                        <p style="margin:6px 0 0 0; font-size:14px; line-height:20px; color:#6b7280;">
                            {{ now()->format('d.m.Y H:i') }}
                        </p>
                    </td>
                </tr>

                {{-- Durum rozeti --}}
                <tr>
                    <td style="padding:16px 32px 8px 32px;">
                            <span style="display:inline-block; padding:6px 12px; border-radius:999px; background-color:#dcfce7; color:#15803d; font-size:13px; font-weight:600;">
                                ✓ @lang('Published')
                            </span>
                    </td>
                </tr>

                {{-- Açıklama --}}
                <tr>
                    <td style="padding:16px 32px 8px 32px;">
                        <p style="margin:0; font-size:15px; line-height:24px; color:#374151;">
                            @lang('Posts for date :scheduledDate have been published. The publication date for these posts has been set as :date.', [
                                'scheduledDate' => $scheduledDate,
                                'date' => now()->format('Y-m-d'),
                            ])
                        </p>
                    </td>
                </tr>

                {{-- Tarih kartları --}}
                <tr>
                    <td style="padding:16px 32px 8px 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td width="50%" style="padding-right:6px;">
                                    <div style="background-color:#eff6ff; border:1px solid #bfdbfe; border-radius:10px; padding:16px 8px; text-align:center;">
                                        <div style="font-size:20px; line-height:28px; font-weight:700; color:#1d4ed8;">{{ $scheduledDate }}</div>
                                        <div style="margin-top:4px; font-size:12px; line-height:16px; color:#1e40af; text-transform:uppercase; letter-spacing:.04em;">@lang('Scheduled date')</div>
                                    </div>
                                </td>
                                <td width="50%" style="padding-left:6px;">
                                    <div style="background-color:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px; padding:16px 8px; text-align:center;">
                                        <div style="font-size:20px; line-height:28px; font-weight:700; color:#15803d;">{{ now()->format('Y-m-d') }}</div>
                                        <div style="margin-top:4px; font-size:12px; line-height:16px; color:#166534; text-transform:uppercase; letter-spacing:.04em;">@lang('Publication date')</div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- İmza --}}
                <tr>
                    <td style="padding:20px 32px 8px 32px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #e5e7eb;">
                            <tr>
                                <td style="padding-top:16px; font-size:14px; line-height:22px; color:#374151;">
                                    @lang('Thanks'),<br>
                                    <strong>{{ config('app.name') }}</strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Alt bilgi --}}
                <tr>
                    <td style="padding:16px 32px 28px 32px;">
                        <p style="margin:0; font-size:12px; line-height:18px; color:#9ca3af;">
                            @lang('This email was generated automatically, please do not reply.')
                        </p>
                    </td>
                </tr>

            </table>

            <p style="margin:16px 0 0 0; font-size:12px; color:#9ca3af;">
                © {{ date('Y') }} {{ config('app.name') }}
            </p>

        </td>
    </tr>
</table>

</body>
</html>
