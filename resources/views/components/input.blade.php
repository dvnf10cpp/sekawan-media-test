<div class="tw-mb-4">
  <label for="{{ $id }}" class="tw-block tw-mb-2 lg:tw-text-lg tw-text-gray-300">
    {{ $name }}
    @if($required)
      <span class="tw-text-red-500">*</span>
    @endif
  </label>
  <input
    type="{{ $type }}"
    class="tw-py-2 tw-px-4 tw-w-full tw-rounded-md tw-border tw-border-gray-600 tw-bg-gray-700 tw-text-gray-200 placeholder:tw-text-gray-400 focus:tw-border-blue-500 focus:tw-outline-none hover:tw-border-gray-400"
    id="{{ $id }}"
    name="{{ $id }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    @if($required) required @endif
  />
  @error($id)
  <span class="tw-text-red-500">{{ $message }}</span>
  @enderror
</div>
