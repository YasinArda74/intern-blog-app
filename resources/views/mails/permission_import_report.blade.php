<h2>Permission Import Raporu</h2>

@if ($error)
    <p style="color:#b91c1c">Import sırasında hata oluştu:</p>
    <pre>{{ $error }}</pre>
@else
    <ul>
        <li>Yeni eklenen: <strong>{{ $created }}</strong></li>
        <li>Zaten var olan: <strong>{{ $existing }}</strong></li>
        <li>Boş satır: <strong>{{ $empty }}</strong></li>
    </ul>
@endif
