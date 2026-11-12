<!DOCTYPE html>
<html lang="tr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <title>Permission Import Raporu</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color:#111827;">

{{-- Önizleme metni (gelen kutusunda görünen kısa özet) --}}
<div style="display:none; max-height:0; overflow:hidden; opacity:0; color:transparent;">
    @if ($error)
        Permission import sırasında hata oluştu.
    @else
        Permission import tamamlandı: {{ $created }} yeni, {{ $existing }} mevcut, {{ $empty }} boş satır.
    @endif
</div>

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3f4f6; padding:32px 12px;">
    <tr>
        <td align="center">

            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:560px; background-color:#ffffff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">

                {{-- Üst şerit --}}
                <tr>
                    <td style="height:6px; line-height:6px; font-size:0; background-color:{{ $error ? '#dc2626' : '#16a34a' }};">&nbsp;</td>
                </tr>

                {{-- Başlık --}}
                <tr>
                    <td style="padding:28px 32px 8px 32px;">
                        <h1 style="margin:0; font-size:22px; line-height:28px; font-weight:700; color:#111827;">
                            Permission Import Raporu
                        </h1>
                        <p style="margin:6px 0 0 0; font-size:14px; line-height:20px; color:#6b7280;">
                            {{ now()->format('d.m.Y H:i') }}
                        </p>
                    </td>
                </tr>

                {{-- Durum rozeti --}}
                <tr>
                    <td style="padding:16px 32px 8px 32px;">
                        @if ($error)
                            <span style="display:inline-block; padding:6px 12px; border-radius:999px; background-color:#fee2e2; color:#b91c1c; font-size:13px; font-weight:600;">
                                    ✕ Başarısız
                                </span>
                        @else
                            <span style="display:inline-block; padding:6px 12px; border-radius:999px; background-color:#dcfce7; color:#15803d; font-size:13px; font-weight:600;">
                                    ✓ Başarıyla tamamlandı
                                </span>
                        @endif
                    </td>
                </tr>

                @if ($error)
                    {{-- Hata durumu --}}
                    <tr>
                        <td style="padding:16px 32px 8px 32px;">
                            <p style="margin:0 0 12px 0; font-size:15px; line-height:22px; color:#b91c1c; font-weight:600;">
                                Import sırasında hata oluştu:
                            </p>
                            <div style="background-color:#fef2f2; border:1px solid #fecaca; border-left:4px solid #dc2626; border-radius:8px; padding:14px 16px;">
                                <pre style="margin:0; font-family:SFMono-Regular, Menlo, Consolas, 'Liberation Mono', monospace; font-size:13px; line-height:20px; color:#7f1d1d; white-space:pre-wrap; word-break:break-word;">{{ $error }}</pre>
                            </div>
                        </td>
                    </tr>
                @else
                    {{-- Özet kartları --}}
                    <tr>
                        <td style="padding:16px 32px 8px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="33.33%" style="padding-right:6px;">
                                        <div style="background-color:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px; padding:16px 8px; text-align:center;">
                                            <div style="font-size:28px; line-height:32px; font-weight:700; color:#15803d;">{{ $created }}</div>
                                            <div style="margin-top:4px; font-size:12px; line-height:16px; color:#166534; text-transform:uppercase; letter-spacing:.04em;">Yeni eklenen</div>
                                        </div>
                                    </td>
                                    <td width="33.33%" style="padding:0 3px;">
                                        <div style="background-color:#eff6ff; border:1px solid #bfdbfe; border-radius:10px; padding:16px 8px; text-align:center;">
                                            <div style="font-size:28px; line-height:32px; font-weight:700; color:#1d4ed8;">{{ $existing }}</div>
                                            <div style="margin-top:4px; font-size:12px; line-height:16px; color:#1e40af; text-transform:uppercase; letter-spacing:.04em;">Zaten var</div>
                                        </div>
                                    </td>
                                    <td width="33.33%" style="padding-left:6px;">
                                        <div style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:16px 8px; text-align:center;">
                                            <div style="font-size:28px; line-height:32px; font-weight:700; color:#4b5563;">{{ $empty }}</div>
                                            <div style="margin-top:4px; font-size:12px; line-height:16px; color:#374151; text-transform:uppercase; letter-spacing:.04em;">Boş satır</div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Toplam --}}
                    <tr>
                        <td style="padding:12px 32px 8px 32px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #e5e7eb;">
                                <tr>
                                    <td style="padding-top:14px; font-size:14px; color:#6b7280;">Toplam işlenen satır</td>
                                    <td align="right" style="padding-top:14px; font-size:14px; font-weight:700; color:#111827;">
                                        {{ $created + $existing + $empty }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif

                {{-- Alt bilgi --}}
                <tr>
                    <td style="padding:24px 32px 28px 32px;">
                        <p style="margin:0; font-size:12px; line-height:18px; color:#9ca3af;">
                            Bu e-posta otomatik olarak oluşturulmuştur, lütfen yanıtlamayınız.
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
