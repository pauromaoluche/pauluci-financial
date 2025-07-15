<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Verificação de reembolso</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f9fafb; font-family: 'Segoe UI', sans-serif; color: #333333;">

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="background-color: #f9fafb; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                    <tr>
                        <td style="padding: 32px 40px; text-align: center;">
                            <!-- Logo -->
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="#2563eb"
                                style="margin-bottom: 12px;">
                                <path d="M4 4h16v3H4zM3 8h18v2H3zM4 12h16v8H4z" />
                            </svg>
                            <h1 style="margin: 0; font-size: 24px; color: #111827;">Olá, {{ $user->name }}!</h1>
                            <p style="font-size: 16px; margin-top: 12px; color: #4b5563;">
                                Um usuario pediu um reembolso de uma transação</strong>!
                            </p>
                            <p style="font-size: 16px; color: #4b5563;">
                                Para aceitar o reembolso:
                            </p>
                            <div style="margin-top: 24px; margin-bottom: 32px;">
                                <a href="{{ $approveUrl }}"
                                    style="display: inline-block; padding: 12px 24px; background-color: #2563eb; color: #ffffff; text-decoration: none; font-weight: 600; border-radius: 8px;">
                                    Aceitar
                                </a>
                            </div>

                            </p>
                            <p style="font-size: 16px; color: #4b5563;">
                                Para recusar o reembolso:
                            </p>
                            <div style="margin-top: 24px; margin-bottom: 32px;">
                                <a href="{{ $denyUrl }}"
                                    style="display: inline-block; padding: 12px 24px; background-color: #2563eb; color: #ffffff; text-decoration: none; font-weight: 600; border-radius: 8px;">
                                    Recusar
                                </a>
                            </div>
                            <hr style="margin: 32px 0; border: none; border-top: 1px solid #e5e7eb;">
                            <p style="font-size: 12px; color: #9ca3af;">
                                Atenciosamente,<br>
                                Equipe {{ config('app.name') }}
                            </p>
                        </td>
                    </tr>
                </table>
                <p style="margin-top: 16px; font-size: 12px; color: #9ca3af;">© {{ date('Y') }}
                    {{ config('app.name') }}. Todos os direitos reservados.</p>
            </td>
        </tr>
    </table>

</body>

</html>
