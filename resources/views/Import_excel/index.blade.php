<!DOCTYPE html>
<html>
<head>
    <title>Server Shop - Admin Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
</head>

<body>
    
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Server Shop - Admin Panel
        </div>
    @if($message = Session::get('error'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
        <div class="card-body">
            <form action="{{ url('import-excel') }}" method="POST" name="importform" enctype="multipart/form-data">
                @csrf
                <input type="file" name="import_file" class="form-control">
                <br>
                <button class="btn btn-success">Import File</button>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Customer Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>Model</th>
        <th>RAM</th>
        <th>HDD</th>
        <th>Location</th>
        <th>Price</th>
        </tr>
       @foreach($serverDetail as $c)
       <tr>
        <td>{{ $c->model }}</td>
        <td>{{ $c->ram }}</td>
        <td>{{ $c->hardisk }}</td>
        <td>{{ $c->location }}</td>
        <td>{{ $c->price }}</td>
       </tr>
       @endforeach
      </table>
     </div>
    </div>
</div>

</div>
    
</body>
</html>