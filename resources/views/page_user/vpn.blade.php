@extends('layouts.appUser')

@section('title')
VPN
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('List VPN') }}</div>

                <div class="card-body">
                    <div class="col-sm-4">
                        <a href="#" class="btn btn-primary" id="addData">Add Data</a>
                    </div><br>
                    <table id="vpnTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama VPN</th>
                                <th>Nama User</th>
                                <th>Nama Paket</th>
                                <th>IP</th>
                                <th>Port</th>
                                <th>Bayar</th>
                                <th>Tanggal Aktif</th>
                                <th>Tanggal Non Aktif</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            <tr></tr>
                        </tbody> --}}
                        <tfoot>
                            <tr>
                                <th>Nama VPN</th>
                                <th>Nama User</th>
                                <th>Nama Paket</th>
                                <th>IP</th>
                                <th>Port</th>
                                <th>Bayar</th>
                                <th>Tanggal Aktif</th>
                                <th>Tanggal Non Aktif</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modalEdit" id="addDataModal" tabindex="-1" aria-labelledby="addData" aria-hidden="true">
    <div class="modal-dialog modal-m modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addData">Add new VPN</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="postData" name="postData" class="form-horizontal form" >
  
            <div class="mb-3 row">
              <label class="col-sm-2 control-label">Nama VPN</label>
              <div class="col-lg-12">
                <div class="input-group">
                    <input type="hidden" name="id">
                  <input type="text" class="form-control" id="nama_vpn" name="nama_vpn" placeholder="Enter Nama VPN" value="" >
                </div>
              </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 control-label">Paket</label>
                <div class="col-lg-12">
                  <div class="input-group">
                    <input type="text" class="form-control" id="id_paket" name="id_paket" placeholder="Enter Paket" value="" >
                  </div>
                </div>
              </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <a class="btn btn-success btn-add" href="#" id="savedata" value="create">Save</a>
              <a class="btn btn-primary btn-edit" href="#" id="savedataedit" value="create">Save</a> --}}
              <button type="submit" class="btn btn-success btn-add" id="savedata" value="create">Save</button>
              <button type="submit" class="btn btn-primary btn-edit" id="savedataedit" value="create">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('after-script')
<script type="text/javascript">
    $(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var modal = $('.modalEdit')
        var form = $('#postData')

        var vpn = $('#vpnTable').DataTable({
            processing: true,
            serverside: true,
            ajax: '/get-vpn',
            columns: [
                {data: 'nama_vpn', name: 'nama_vpn'},
                {data: 'id_user', name: 'id_user'},
                {data: 'id_paket', name: 'id_paket'},
                {data: 'ip', name: 'ip'},
                {data: 'port', name: 'port'},
                {data: 'bayar', name: 'bayar'},
                {data: 'tgl_activ', name: 'tgl_activ'},
                {data: 'tgl_inactiv', name: 'tgl_inactiv'},
                {data: 'action', name: 'action'},
            ]
        });

        
        $('#addData').click(function (){
            modal.modal('show');
            form.trigger("reset");
            $('#savedataedit').hide();
            $('#savedata').show();
        });

        $('#savedata').click(function (){
          console.log('a');
            $.ajax({
                data: form.serialize(),
                url: '/add-vpn',
                type: "post",
                dataType: 'json',
                success: function(data){
                  $('$postData').trigger("reset");
                  $('$addDataModal').modal('hide');
                  vpn.ajax.reload();
                },
                error: function(data){
                    console.log('Error : ',data);
                }
            })
        });

        $('body').on('click', '.lookData', function(){
            var id = $(this).data("id");
            modal.modal('show');
            $('#savedataedit').show();
            $('#savedata').hide();

            modal.find('.modal-title').text('Update Data');
            var data= vpn.row($(this).parents('tr')).data()

            form.find('input[name="id"]').val(data.id)
            form.find('input[name="nama_vpn"]').val(data.nama_vpn)
            form.find('input[name="id_paket"]').val(data.id_paket)
        });

        $('#savedataedit').click(function(){
            var id = form.find('input[name="id"]').val()
            $.ajax({
                type:"POST",
                data: form.serialize(),
                dataType: 'json',
                url: '/update-vpn/'+id,
                success: function(data){
                  $('$postData').trigger("reset");
                  $('$addDataModal').modal('hide');
                  vpn.ajax.relod();
                },
                error: function(data){
                    console.log('Error : ',data);
                }
            })
        });

        $('body').on('click', '.deleteData', function(){
            var id = $(this).data("id");
            $.ajax({
                type: "DELETE",
                url: '/delete-vpn/'+id,
                success : function (data){
                    vpn.ajax.reload()
                    console.log("success")
                },
                error: function (data){
                    console.log("Error : ",data);
                }
            })
        });


    })
</script>
@endpush