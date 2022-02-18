<section class="basic-timeline">
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Basic</h4>
        </div>
        <div class="card-body">
          <ul class="timeline">
          @foreach($options as $option)
          @if (is_string($option))
            <li class="timeline-item">
              <span class="timeline-point timeline-point-indicator"></span>
              <div class="timeline-event">
                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                  <h6>{{__($option->title) }}</h6>
                  <span class="timeline-event-time">{{$option->date}}</span>
                </div>
                <p>{{__($option->content) }}</p>
                <div class="d-flex flex-row align-items-center">
                  <img
                    class="me-1"
                    src="{{$option->url}}"
                    alt="invoice"
                    height="23"
                  />
                  <span>$option->name_url</span>
                </div>
              </div>
            </li>
            @endif
          @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>