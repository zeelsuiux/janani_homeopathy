document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('input[type="file"]').forEach((input) => {
    const preview = document.createElement('div');
    preview.className = 'file-preview-list';
    input.insertAdjacentElement('afterend', preview);

    input.addEventListener('change', () => {
      preview.replaceChildren();
      [...input.files].forEach((file) => {
        const item = document.createElement('div');
        item.className = 'file-preview-item';
        const url = URL.createObjectURL(file);
        if (file.type.startsWith('video/')) {
          const video = document.createElement('video');
          video.src = url;
          video.controls = true;
          video.muted = true;
          video.preload = 'metadata';
          item.append(video);
        } else if (file.type.startsWith('image/')) {
          const image = document.createElement('img');
          image.src = url;
          image.alt = file.name;
          item.append(image);
        } else {
          item.textContent = file.name;
        }
        const name = document.createElement('small');
        name.textContent = file.name;
        item.append(name);
        preview.append(item);
      });
    });
  });
});
