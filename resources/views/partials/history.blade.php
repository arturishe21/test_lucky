<table style="width: 100%">
	<thead>
		<tr>
			<td>Status</td>
			<td>Total</td>
		</tr>
	</thead>
	<tbody>
	@foreach($result as $item)
		<tr>
			<td>{{$item->is_win ? 'Win' : 'Lose'}}</td>
			<td>{{$item->total}}</td>
		</tr>
	@endforeach
	</tbody>
</table>