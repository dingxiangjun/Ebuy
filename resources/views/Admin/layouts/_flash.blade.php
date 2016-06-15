<script src="/amaze/js/jquery.min.js"></script>
@if (session('success'))
    <script type="text/javascript">
        $(function () {
            $('#on').trigger("click");
        })
    </script>
    <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
      <div class="am-modal-dialog" style="width: 450px">
          <div class="am-g">
              <div class="am-u-md-12" style=" padding-right: 0px;padding-left: 0px;">
                  <div class="am-alert am-alert-warning" style="border: none;">
                      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                      提示
                  </div>
              </div>
          </div>
        <div class="am-modal-bd" style="padding: 25px 10px 35px 10px;font-size: 18px;">
          {{ session('success') }}
        </div>
      </div>
    </div>
    
@endif

@if (session('error'))
    <script type="text/javascript">
        $(function () {
            $('#on').trigger("click");
        })
    </script>
    <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
        <div class="am-modal-dialog" style="width: 450px">
            <div class="am-g">
                <div class="am-u-md-12" style=" padding-right: 0px;padding-left: 0px;">
                    <div class="am-alert am-alert-danger" style="border: none;">
                        <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                        提示
                    </div>
                </div>
            </div>
            <div class="am-modal-bd" style="padding: 25px 10px 35px 10px;font-size: 18px;">
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif

@if (session('info'))
    <script type="text/javascript">
        $(function () {
            $('#on').trigger("click");
        })
    </script>
    <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
        <div class="am-modal-dialog" style="width: 450px">
            <div class="am-g">
                <div class="am-u-md-12" style=" padding-right: 0px;padding-left: 0px;">
                    <div class="am-alert am-alert-success" style="border: none;">
                        <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                        提示
                    </div>
                </div>
            </div>
            <div class="am-modal-bd" style="padding: 25px 10px 35px 10px;font-size: 18px;">
                {{ session('info') }}
            </div>
        </div>
    </div>
@endif


@if (count($errors) > 0)
    <div class="am-g">
        <div class="am-u-md-12">
            <div class="am-alert am-alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif