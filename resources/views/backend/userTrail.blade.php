@extends('layouts.admin')
@section('content')

<div class="container-fluid">
	<div class="row" style="padding:10px;">
        <div class="col-md-6">
          <span style="font-size: 20px;">User Management</span>
        </div>
        <div class="col-md-6 text-right">
        </div>
    </div>
    <div class="err-msg"></div>
    <table id="example" class="display" style="width:100%">
        <thead>
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
            <?php foreach($data as $row) { ?>
            <tr>
                <td>{{ $i }}</td>
                <td>{{ @$row['firstname'] }}{{ @$row['lastname'] }}</td>
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
        <tfoot>
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
    <script>

        $(document).ready(function() {
        $('#example').DataTable();
    } );
        function editSubscription(id)
        {
            window.location.href="{{ url('Admin/editSubscriptionForm/')}}/"+id;
        }
    </script>

 @endsection