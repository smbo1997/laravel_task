
    <div class="row chat-window col-xs-5 col-md-3" id="chat_window_1" user="{{Auth::user()->id}}" style="display: none">
        <div class="chatnotification" style="display: none">
            <audio controls id="playsound">
                <source src="{{URL::asset('chat_sound/chat.wav')}}" type="audio/wav">
            </audio>
        </div>
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading top-bar">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-comment" style="color: #00dd00"></span>Chat</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="width:94px;margin-top: -20px;float: right;text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                            <a href="#"><span class="glyphicon glyphicon-remove icon_close" data-id="chat_window_1"></span></a>
                    </div>
                </div>
                <div class="panel-body msg_container_base" style="display: none;" style="height: 200px">

                    <div class="row msg_container base_sent">
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_sent">
                                <p>
                                    Hi dear. Can we help you?
                                </p>

                            </div>
                        </div>
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
                        </div>
                    </div>

                    <div class="addcontent">

                    </div>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm chat_input messagecontent" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm sendmessage" clicked="0" id="btn-chat" disabled="disabled">Send</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

