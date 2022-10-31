<div class="btn-group">
    <button type="button" class="btn btn-danger" onclick="statusUser({{ $id }})">Status</button>
    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" style="">
        <li><a class="dropdown-item" onclick="deleteVer({{ $id }})">Hapus</a></li>
    </ul>
</div>
