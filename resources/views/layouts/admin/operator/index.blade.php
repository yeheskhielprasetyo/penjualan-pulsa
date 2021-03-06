@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="section">
        <div class="card" style="width:100%;">
            <div class="card-body">
                <h2 class="card-title" style="color: black;">Data Operator</h2>
                <hr>
                <button class="btn btn-success" data-toggle="modal" data-target="#tambahModal" data-whatever="@mdo">Tambah
                    Operator ⭢</button> <br><br>
                    @if ($errors->any())
                    <div class="alert alert-danger" style="max-width: 50%">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                        <div class="table-responsive">
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {!! $dataTable->scripts() !!}
</div>


<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Operator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('operator.store')}}">
            @csrf
            <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Operator</label>
            <input type="text" class="form-control" id="recipient-name"  name="nama_operator">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Stock</label>
                <input type="text" class="form-control" id="recipient-name"  name="stock">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Harga</label>
                <input type="text" class="form-control" id="recipient-name"  name="harga">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>

    </div>
    </div>
</div>

<div id="result"></div>
<script>
    function actionoperator(action,id){
        $.ajax({
        url:"operator/"+action+"/"+id,
        method:"GET",
            success:function(data){
                $('#result').html(data.html);
            },
            error:function() {
            alert("gagal");
            }
        });
    }
</script>
@endsection
