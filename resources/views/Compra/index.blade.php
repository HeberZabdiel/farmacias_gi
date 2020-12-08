<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
        <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('js\popper.min.js') }}"></script>
        <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    </head>
    <body>
    <div class="modal" tabindex="-1" id="myModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
  $('#myModal').on('hidden.bs.modal', function (e) {
  // do something...
})
</script>
    </body>
</html>