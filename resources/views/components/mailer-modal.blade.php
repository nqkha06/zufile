@props(['id','mailer','action','method'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <div class="modal-header border-0">
        <h5 class="modal-title">Sửa mailer: {{ $mailer->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body pt-0">
        <x-mailer-form :mailer="$mailer" :action="$action" :method="$method" />
      </div>
    </div>
  </div>
</div>
