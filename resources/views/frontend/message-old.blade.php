@extends('layouts.home')
@section('content')
    <section class="account_page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <h2 class="title">LondCap <span>Mail</span></h2>
                    <div class="sidebar-menu">
                        <ul>
                            <li class="active"><a href="#">Inbox</a></li>
                            <li><a href="#">Outbox</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
                    <div class="messages-content">
                        <div class="messages-header clearfix">
                            <ul class="actions">
                                <li class="compose"><a href="#" class="btn btn-primary btn-compose">+ Compose New</a></li>
                                <li class="delete"><a href="#">Delete</a></li>
                                <li class="mark-unread"><a href="#">Mark Unread</a></li>
                            </ul>
                        </div><!-- .messages-header -->
                        <div class="user-messaging-empty">
                            <p>You have no messages</p>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end pull-right">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">«</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <span aria-hidden="true">»</span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="new-message" style="display: none;">
        <div class="user-message-header">
            <h2>New Message</h2>
            <a href="#" class="message-close">x</a>
        </div><!-- .user-message-header -->
        <div class="user-message-content">
            <form class="form">
                <div class="form-group">
    <input type="email" class="form-control" placeholder="To:">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Subject:">
                </div><div class="form-group">
    <textarea class="form-control" rows="6" placeholder="Message:"></textarea>
                </div>
  <button type="submit" class="btn btn-primary">Send Message</button>
            </form><!-- #quick-message-send -->
        </div><!-- user-message-content -->
    </div>
   @endsection