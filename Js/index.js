const input = document.getElementById("upload_avatar_input");

const form = document.getElementById("upload_avatar_form");

input.addEventListener("change", () => {
  form.submit();
});
