@extends('layout')

@section('main')
	<div class="row justify-content-md-center" style="padding: 100px 0">
		<div class="col col-lg-6">
			<p><botton type="button" onclick="generateNewLink()" class="btn btn-outline-primary">generate new link</botton> </p>

			<p><botton type="button" onclick="removeLink()()" class="btn btn-outline-primary">deactivate link</botton> </p>
			<p><botton type="button" onclick="feelingLucky()" class="btn btn-outline-primary">Im feeling lucky</botton></p>
			<p><botton type="button" onclick="getHistory()" class="btn btn-outline-primary">History</botton></p>
		</div>
	</div>

	<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="historyModalLabel">History</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="feelingLucky" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="feelingLucky">Result</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="generateNewLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="generateNewLink">New link</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>

	<script>

		function removeLink() {
            $.ajax({
                type:'POST',
                url:'/remove-link',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : {
                    signature : '{{request('signature')}}',
                },
                success : function(data){
                    alert('The link is removed');
                   setTimeout("location.href = '/'", 1000);
                }
            });
        }

		function generateNewLink() {
            $.ajax({
                type:'POST',
                url:'/generate-new-link',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : {
                    signature : '{{request('signature')}}',
                },
                success : function(data){
                    $('#generateNewLink .modal-body').html(data);
                    $('#generateNewLink').modal('show');
                }
            });
        }

		function feelingLucky() {

            $.ajax({
                type:'POST',
                url:'/feeling-lucky',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data : {
                    signature : '{{request('signature')}}',
                },
                success : function(data){
                    $('#feelingLucky .modal-body').html(data);
                    $('#feelingLucky').modal('show');
                }
            });
        }

        function getHistory() {

            $.ajax({
                type:'POST',
                url:'/get-history',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data : {
                    signature : '{{request('signature')}}',
				},
                success : function(data){
                    $('#historyModal .modal-body').html(data);
                    $('#historyModal').modal('show');
                }
            });

        }
	</script>
@stop