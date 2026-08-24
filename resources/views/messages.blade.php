@if (session('success_basket1'))
    <div id="success-popup" class="success-popup">{{ session('success_basket1') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif
@if (session('success_basket2'))
    <div id="success-popup" class="success-popup">{{ session('success_basket2') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('success-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif
@if (session('success_basket3'))
    <div id="success-popup" class="success-popup">{{ session('success_basket3') }}</div>
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
@if (session('error_basket1'))
    <div id="error-popup" class="error-popup">{{ session('error_basket1') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif 
@if (session('error_basket2'))
    <div id="error-popup" class="error-popup">{{ session('error_basket2') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif 
@if (session('error_basket3'))
    <div id="error-popup" class="error-popup">{{ session('error_basket3') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
    </script>
@endif
@if (session('error_basket4'))
    <div id="error-popup" class="error-popup">{{ session('error_basket4') }}</div>
    <script>
        setTimeout(() => {const popup = document.getElementById('error-popup');if (popup) {popup.classList.add('hide');setTimeout(() => {popup.remove();}, 300);}}, 3000);
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