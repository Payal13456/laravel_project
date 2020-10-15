@extends('layouts.app')

@section('content')
 @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Welcome {{Auth::user()->name}} 
                    @if(Auth::user()->role != 'user') 
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary" style="float: right;" onclick="createPost();">Create Post</a>
                    @endif
                </div>
                <div class="card-body">
                   @if(isset($post) && count($post) > 0)
                    @foreach($post as $p)
                      <h4>{{$p->title}} @if(Auth::user()->role != 'user') <span style="float: right;font-size: 15px;"><a href="javascript:void(0);" class="text-info" onclick="editPost({{$p->id}});">Edit</a></span> @endif</h4>
                      <p>{{$p->description}} </p>
                      @if($p->featured_image != '')
                        <img src="{{ assets('images')}}/{{$p->featured_image}}">
                      @endif
                    @endforeach
                   @else
                        <p>No Post Available</p>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div id="addPost" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Post</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="loadData">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function createPost(){
    $.ajax({
        url : '{{url("posts/create")}}',
        type : 'GET',
        success : function(res){
            $('#loadData').html(res);
            $('#addPost').modal('show');
        }
    })
  }
  function editPost(id){
    $.ajax({
        url : '{{url("/")}}/posts/'+id+'/edit',
        type : 'GET',
        success : function(res){
            $('#loadData').html(res);
            $('#addPost').modal('show');
        }
    })
  }
  
</script>
@endsection
