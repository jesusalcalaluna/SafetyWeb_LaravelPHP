@if (session('success'))
    <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
            <div class="swal2-header">

                <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                    <span class="swal2-success-line-tip"></span> 
                    <span class="swal2-success-line-long"></span>
                    <div class="swal2-success-ring"></div> 
                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                </div>

                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Bien!</h2>

            </div>
            <div class="swal2-content">
                <div id="swal2-content" style="display: block;">{{ session('success') }}</div>

            </div>
            <div class="swal2-actions" style="display: flex;">
                <button type="button" class="swal2-confirm btn long" onclick="$('.swal2-container').remove();">Entendido</button>
            </div>

        </div>
    </div>
@endif
@if (session('error'))
    <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
            <div class="swal2-header">
                
                <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                    <span class="swal2-x-mark">
                        <span class="swal2-x-mark-line-left"></span>
                        <span class="swal2-x-mark-line-right"></span>
                    </span>
                </div>
                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Error!</h2>
                <div class="swal2-content">
                    <div id="swal2-content" style="display: block;"> {{ session('error') }}</div>
                </div>
                <div class="swal2-actions" style="display: flex;">
                    <button type="button" class="swal2-confirm btn long" onclick="$('.swal2-container').remove();">Entendido</button>
                </div>
            </div>
        </div>
    </div>
@endif
@if (session('warning'))
    <div class="swal2-container swal2-center swal2-fade swal2-shown" style="overflow-y: auto;">
        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
            <div class="swal2-header">
                <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                    <span class="swal2-icon-text">!</span>
                </div>

                <h2 class="swal2-title" id="swal2-title" style="display: flex;">Cuidado!</h2>

            </div>
            <div class="swal2-content">
                <div id="swal2-content" style="display: block;"> {{ session('warning') }}</div>
            </div>
            <div class="swal2-actions" style="display: flex;">
                <button type="button" class="swal2-confirm btn long" onclick="$('.swal2-container').remove();" aria-label="">OK</button>
            </div>
        </div>
    </div>
@endif

