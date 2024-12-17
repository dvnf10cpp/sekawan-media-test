@if(session('failed'))
<div class="tw-mb-4 tw-bg-red-600/10 tw-border tw-border-red-600 tw-text-red-600 tw-rounded-md tw-p-4 tw-flex tw-items-center tw-justify-between alert alert-warning alert-dismissible fade show" role="alert">
  <div class="tw-flex tw-items-center">
    <iconify-icon icon="mdi:alert-circle-outline" class="tw-text-red-600 tw-mr-2" width="1.5em" height="1.5em"></iconify-icon>
    <span>{{ session('failed') }}</span>
  </div>
  <button type="button" class="btn-close tw-text-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('success'))
<div class="tw-mb-4 tw-bg-green-600/10 tw-border tw-border-green-600 tw-text-green-600 tw-rounded-md tw-p-4 tw-flex tw-items-center tw-justify-between alert alert-warning alert-dismissible fade show" role="alert">
  <div class="tw-flex tw-items-center">
    <iconify-icon icon="mdi:check-circle-outline" class="tw-text-green-600 tw-mr-2" width="1.5em" height="1.5em"></iconify-icon>
    <span>{{ session('success') }}</span>
  </div>
  <button type="button" class="btn-close tw-text-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
