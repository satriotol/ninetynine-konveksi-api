<tr>
    <td class="header">
        <div href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="https://apininetyninekonveksi.krotidesian.xyz/public/99logo-min.png" class="logo"
                alt="Laravel Logo">
            @else
            {{ $slot }}
            @endif
        </div>
    </td>
</tr>