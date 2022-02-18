<section id="colored-progress">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Colored Progress</h4>
        </div>
        <div class="card-body">
          <p class="card-text">Use class <code>.progress-bar-{color-name}</code>. to choose color of your choice.</p>
          <div class="demo-vertical-spacing">
          @foreach($options as $key => $option)
            @if (is_string($option))
            <div class="progress progress-bar-{{$option->name}}">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow="{{$option->valuenow}}"
                aria-valuemin="{{$option->valuemin}}"
                aria-valuemax="100"
                style="{{$option->valuemin}}"
              ></div>
            </div>
            @endif
          @endforeach
            <!-- <div class="progress progress-bar-secondary">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow="35"
                aria-valuemin="35"
                aria-valuemax="100"
                style="width: 35%"
              ></div>
            </div>
            <div class="progress progress-bar-success">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow="45"
                aria-valuemin="45"
                aria-valuemax="100"
                style="width: 45%"
              ></div>
            </div>
            <div class="progress progress-bar-danger">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow="55"
                aria-valuemin="55"
                aria-valuemax="100"
                style="width: 55%"
              ></div>
            </div>
            <div class="progress progress-bar-warning">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow="65"
                aria-valuemin="65"
                aria-valuemax="100"
                style="width: 65%"
              ></div>
            </div>
            <div class="progress progress-bar-info">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow="75"
                aria-valuemin="75"
                aria-valuemax="100"
                style="width: 75%"
              ></div>
            </div>
            <div class="progress progress-bar-dark">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow="85"
                aria-valuemin="85"
                aria-valuemax="100"
                style="width: 85%"
              ></div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>