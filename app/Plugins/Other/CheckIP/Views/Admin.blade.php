@extends($templatePathAdmin.'layout')

@section('main')
@php
    $id = empty($id) ? 0 : $id;
@endphp
<div class="row">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{!! $title_action !!}</h3>
        @if ($layout == 'edit')
        <div class="btn-group float-right" style="margin-right: 5px">
            <a href="{{ sc_route_admin('admin_checkip.index') }}" class="btn  btn-flat btn-default" title="List"><i class="fa fa-list"></i><span class="hidden-xs"> {{ sc_language_render('admin.back_list') }}</span></a>
        </div>
      @endif
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ $url_action }}" method="post" accept-charset="UTF-8" class="form-horizontal" id="form-main">
        <div class="card-body">

          <div class="form-group row {{ $errors->has('description') ? ' text-red' : '' }}">
            <label for="description" class="col-sm-2 col-form-label">{{ sc_language_render('admin.checkip.description') }}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                <input type="text" id="description" name="description" value="{{ old()?old('description'):$ipRow['description']??'' }}" class="form-control description {{ $errors->has('description') ? ' is-invalid' : '' }}">
              </div>

              @if ($errors->has('description'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('description') }}
              </span>
              @endif

            </div>
          </div>

          <div class="form-group row {{ $errors->has('ip') ? ' text-red' : '' }}">
            <label for="ip" class="col-sm-2 col-form-label">{!! sc_language_render('admin.checkip.ip') !!}</label>
            <div class="col-sm-10 ">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                </div>
                @if (!empty($ipRow['ip']) && in_array($ipRow['ip'], ['vi','en']))
                <input type="hidden" id="ip" name="ip" value="{{ $ipRow['ip'] }}"
                    placeholder="" />
                <input type="text" disabled="disabled" value="{{ $ipRow['ip'] }}"
                    class="form-control" placeholder="" />
                @else
                <input type="text" id="ip" name="ip"
                    value="{{ old()?old('ip'):$ipRow['ip']??'' }}"
                    class="form-control {{ $errors->has('ip') ? ' is-invalid' : '' }}" placeholder="" />
                @endif
              </div>
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {!! sc_language_render('admin.checkip.ip_help') !!}
              </span>
              @if ($errors->has('ip'))
              <span class="text-sm">
                <i class="fa fa-info-circle"></i> {{ $errors->first('ip') }}
              </span>
              @endif

            </div>
          </div>


      {{-- type --}}
      <div class="form-group row kind   {{ $errors->has('type') ? ' text-red' : '' }}">
            <label for="type" class="col-sm-2 col-form-label">{{ sc_language_render('admin.checkip.action') }}</label>
            <div class="col-sm-8">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary_allow" name="type" value="allow" {{ (old('type', $ipRow['type'] ?? '') == 'allow')?'checked':'' }}>
                        <label for="radioPrimary_allow">
                          {{ sc_language_render('admin.checkip.allow') }}
                        </label>
                  </div>
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary_deny" name="type" value="deny" {{ (old('type', $ipRow['type'] ?? '') == 'deny')?'checked':'' }}>
                        <label for="radioPrimary_deny">
                        {{ sc_language_render('admin.checkip.deny') }}
                        </label>
                  </div>
                  @if ($errors->has('type'))
                  <span class="form-text">
                        <i class="fa fa-info-circle"></i> {{ $errors->first('type') }}
                  </span>
                  @endif
            </div>
      </div>
      {{-- //type --}}

        </div>
        <!-- /.card-body -->
        @csrf
        <div class="card-footer">
          <button type="reset" class="btn btn-warning">{{ sc_language_render('action.reset') }}</button>
          <button type="submit" class="btn btn-primary float-right">{{ sc_language_render('action.submit') }}</button>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
  </div>


  <div class="col-md-6">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-th-list"></i> {!! $title ?? '' !!}</h3>
      </div>

      <div class="card-body p-0">
            <section id="pjax-container" class="table-list">
              <div class="box-body table-responsivep-0" >
                 <table class="table table-hover box-body text-wrap table-bordered">
                    <tbody>
                        <tr>
                              <td colspan="4"><h4>IP {{ sc_language_render('admin.checkip.allow') }}</h4></td>
                        </tr>
                        <tr>
                              <tr>
                               @if (!empty($removeList))
                               <th></th>
                               @endif
                               @foreach ($listTh as $key => $th)
                                   <th>{!! $th !!}</th>
                               @endforeach
                              </tr>
                        </tr>
                        @foreach ($dataTrAllow as $keyRow => $tr)
                            <tr class="{{ (request('id') == $tr['id']) ? 'active': '' }}">
                                @if (!empty($removeList))
                                <td>
                                  <input class="checkbox" type="checkbox" class="grid-row-checkbox" data-id="{{ $tr['id']??'' }}">
                                </td>
                                @endif
                                @foreach ($tr as $key => $trtd)
                                    <td>{!! $trtd !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        <tr>
                              <td colspan="4"><h4>IP {{ sc_language_render('admin.checkip.deny') }}</h4></td>
                        </tr>
                        <tr>
                              <tr>
                               @if (!empty($removeList))
                               <th></th>
                               @endif
                               @foreach ($listTh as $key => $th)
                                   <th>{!! $th !!}</th>
                               @endforeach
                              </tr>
                           </tr>
                        @foreach ($dataTrDeny as $keyRow => $tr)
                        <tr class="{{ (request('id') == $tr['id']) ? 'active': '' }}">
                            @if (!empty($removeList))
                            <td>
                              <input class="checkbox" type="checkbox" class="grid-row-checkbox" data-id="{{ $tr['id']??'' }}">
                            </td>
                            @endif
                            @foreach ($tr as $key => $trtd)
                                <td>{!! $trtd !!}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                 </table>

                 <div class="block-pagination clearfix m-10">
                  <div class="ml-3 float-left">
                    {!! $resultItems??'' !!}
                  </div>
                  <div class="pagination pagination-sm mr-3 float-right">
                    {!! $pagination??'' !!}
                  </div>
                </div>


              </div>
             </section>
    </div>



    </div>
  </div>

</div>
</div>
@endsection


@push('styles')
{!! $css ?? '' !!}
@endpush

@push('scripts')
    {{-- //Pjax --}}
   <script src="{{ sc_file('admin/plugin/jquery.pjax.js')}}"></script>

  <script type="text/javascript">

    $('.grid-refresh').click(function(){
      $.pjax.reload({container:'#pjax-container'});
    });

      $(document).on('submit', '#button_search', function(event) {
        $.pjax.submit(event, '#pjax-container')
      })

    $(document).on('pjax:send', function() {
      $('#loading').show()
    })
    $(document).on('pjax:complete', function() {
      $('#loading').hide()
    })

    // tag a
    $(function(){
     $(document).pjax('a.page-link', '#pjax-container')
    })


    $(document).ready(function(){
    // does current browser support PJAX
      if ($.support.pjax) {
        $.pjax.defaults.timeout = 2000; // time in milliseconds
      }
    });

    @if ($buttonSort)
      $('#button_sort').click(function(event) {
        var url = '{{ $urlSort??'' }}?sort_shipping='+$('#shipping_sort option:selected').val();
        $.pjax({url: url, container: '#pjax-container'})
      });
    @endif
    
  </script>
    {{-- //End pjax --}}


<script type="text/javascript">
{{-- sweetalert2 --}}
var selectedRows = function () {
    var selected = [];
    $('.grid-row-checkbox:checked').each(function(){
        selected.push($(this).data('id'));
    });

    return selected;
}

$('.grid-trash').on('click', function() {
  var ids = selectedRows().join();
  deleteItem(ids);
});

  function deleteItem(ids){
  Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: true,
  }).fire({
    title: '{{ sc_language_render('action.delete_confirm') }}',
    text: "",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: '{{ sc_language_render('action.confirm_yes') }}',
    confirmButtonColor: "#DD6B55",
    cancelButtonText: '{{ sc_language_render('action.confirm_no') }}',
    reverseButtons: true,

    preConfirm: function() {
        return new Promise(function(resolve) {
            $.ajax({
                method: 'post',
                url: '{{ $urlDeleteItem ?? '' }}',
                data: {
                  ids:ids,
                    _token: '{{ csrf_token() }}',
                },
                success: function (data) {
                    if(data.error == 1){
                      alertMsg('error', data.msg, '{{ sc_language_render('action.warning') }}');
                      $.pjax.reload('#pjax-container');
                      return;
                    }else{
                      alertMsg('success', data.msg);
                      window.location.replace('{{ sc_route_admin('admin_checkip.index') }}');
                    }

                }
            });
        });
    }

  }).then((result) => {
    if (result.value) {
      alertMsg('success', '{{ sc_language_render('action.delete_confirm_deleted_msg') }}', '{{ sc_language_render('action.delete_confirm_deleted') }}');
    } else if (
      // Read more about handling dismissals
      result.dismiss === Swal.DismissReason.cancel
    ) {
      // swalWithBootstrapButtons.fire(
      //   'Cancelled',
      //   'Your imaginary file is safe :)',
      //   'error'
      // )
    }
  })
}
{{--/ sweetalert2 --}}


</script>

{!! $js ?? '' !!}
@endpush
