@if (session('error3s'))
    <div id="error-popup" class="error-popup">{!! session('error3s') !!}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif 

@if (session('success3s'))
    <div id="success-popup" class="success-popup">{!! session('success3s') !!}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif

@if (session('success5s'))
    <div id="success-popup" class="success-popup">{!! session('success5s') !!}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 5000);
    </script>
@endif







@if (session('error_01'))
    <div id="error-popup" class="error-popup">{{ session('error_01') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif 
@if (session('error_02'))
    <div id="error-popup" class="error-popup">{{ session('error_02') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif 
@if (session('error_03'))
    <div id="error-popup" class="error-popup">{{ session('error_03') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif
@if (session('error_04'))
    <div id="error-popup" class="error-popup">{{ session('error_04') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif 





@if (session('success_02'))
    <div id="success-popup" class="success-popup">{{ session('success_02') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif
@if (session('success_03'))
    <div id="success-popup" class="success-popup">{{ session('success_03') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif






@if (session('onlymessage_basket1'))
    <div id="onlymessage-popup" class="onlymessage-popup">{!! session('onlymessage_basket1') !!}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('onlymessage-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 1000);}}, 10000);
    </script>
@endif









@if (session('success_profile1'))
    <div id="success-popup" class="success-popup">{{ session('success_profile1') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif
@if (session('success_profile2'))
    <div id="success-popup" class="success-popup">{{ session('success_profile2') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif
@if (session('success_profile3'))
    <div id="success-popup" class="success-popup">{{ session('success_profile3') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif


@if (session('error_profile1'))
    <div id="error-popup" class="error-popup">{{ session('error_profile1') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 5000);
    </script>
@endif 
@if (session('error_profile2'))
    <div id="error-popup" class="error-popup">{{ session('error_profile2') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 5000);
    </script>
@endif 
@if (session('error_profile3'))
    <div id="error-popup" class="error-popup">{{ session('error_profile3') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 5000);
    </script>
@endif 


@if (session('success_register1'))
    <div id="success-popup" class="success-popup">{{ session('success_register1') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 10000);
    </script>
@endif




@if (session('success_fotgotpass'))
    <div id="success-popup" class="success-popup">{{ session('success_fotgotpass') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 10000);
    </script>
@endif
@if (session('success_resetpass'))
    <div id="success-popup" class="success-popup">{{ session('success_resetpass') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 10000);
    </script>
@endif


