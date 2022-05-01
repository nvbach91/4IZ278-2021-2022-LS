<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script src="{{ asset('js/tinymce/langs/cs.js') }}"></script>

<script>
  tinymce.init({
    selector: 'textarea#{{ $id }}',
    plugins: 'code table lists',
    language: 'cs',
    height: 400,
    resize: false,
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
  });
</script>