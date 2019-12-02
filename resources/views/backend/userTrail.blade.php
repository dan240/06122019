@extends('layouts.admin')
@section('content')

<div class="container-fluid bg-white">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">User Management</span>
        </div>
        <div class="col-md-6 text-right">
            <form class="form-inline" method="get" action="{{ url('Admin/userTrail') }}">
				<div class="form-group mb-2">
					<input type="text" class="form-control" name="query" placeholder="Find User">
				</div>
				<button type="submit" class="btn btn-primary mb-2">Search</button>
			</form>
        </div>
    </div>

    <div class="err-msg"></div>

    <table class="table table-striped" style="width:100%">
		<thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>User Type</th>
                <th>Email</th>
                <th>Subscription Days</th>
                <th>End Subscription Date</th>
                <th>Plan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            <?php foreach($data["data"] as $row) { ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ @$row['firstname'] }} {{ @$row['lastname'] }}</td>
                <td>
                    <?php if(@$row['usertype']=='1' && @$row['is_Professional']=='1') { 
                        echo "Company - Professional";
                    }else if(@$row['usertype']=='1' && @$row['is_Professional']=='0') {
                        echo "Company - Non Professional";
                    }else if(@$row['usertype']=='2' && @$row['is_Professional']=='1') {
                        echo "Investor - Professional";
                    }else if(@$row['usertype']=='2' && @$row['is_Professional']=='0') {
                        echo "Investor - Non Professional";
                    } ?>
                </td>
                <td>{{ @$row['email'] }}</td>
                <td><?php $curr_date = date('Y-m-d');
                    $date1 = strtotime($curr_date);
                    $date = @$row['activation'];
                    $date2 = strtotime($date);
                    $days = $date2 - $date1;
                    $count_days = $days / (60 * 60 * 24);
                     echo $count_days;?></td>
                <td>{{ @$row['activation'] }}</td>
                <td>{{ @ucfirst($row['subscription_plan']) }}</td>
                <?php if($row['status']==1){ ?>
                    <td>ACTIVE</td>
                <?php }elseif($row['status']==3){ ?>
                    <td>SUSPENDED</td>
                <?php } ?>
                <td>
                    <?php $id = base64_encode(@$row['id']);?>
                    <a class="btn btn-info btn-xs" data-original-title="Extend Subscription" data-toggle="tooltip" data-placement="top" href="javascript:void(0)" onclick="editSubscription('{{$id}}')"><i class="fa fa-edit"></i> 
                    </a>
                </td>
            </tr>
            <?php $i++;} ?>
        </tbody>
        <tfoot  class="thead-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>User Type</th>
                <th>Email</th>
                <th>Subscription Days</th>
                <th>End Subscription Date</th>
                <th>Plan</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
        
    </table>

    <div class="container-fluid">
		<div class="row">
			<div class="col">
				Showing {{ $data['from'] }} to {{ $data['to'] }} of {{ $data['total'] }} entries
			</div>
			<div class="col">
				<nav>
					<ul class="pagination justify-content-end">
						@if ($data['current_page'] != 1)
							<li class="page-item">
								<a class="page-link" href="{{ $data['first_page_url'] }}">&laquo; First</a>
							</li>
						@endif
						@if ($data['prev_page_url'])
							<li class="page-item">
								<a class="page-link" href="{{ $data['prev_page_url'] }}">&lsaquo; Previous</a>
							</li>
						@endif
						
						@if ($data['next_page_url'])
							<li class="page-item">
								<a class="page-link" href="{{ $data['next_page_url'] }}">&rsaquo; Next</a>
							</li>
						@endif
						@if ($data['current_page'] != $data['last_page'])
							<li class="page-item">
								<a class="page-link" href="{{ $data['last_page_url'] }}">&raquo; Last</a>
							</li>
						@endif
					</ul>
				</nav>
			</div>
		</div>
		
	</div>
    <script>

        $(document).ready(function() {
            
        });

        function editSubscription(id) {
            window.location.href="{{ url('Admin/editSubscriptionForm/')}}/"+id;
        }
    </script>

 @endsection