@php
    $items = [
  [
  'image' => asset('assets/images/catalogo/jeanspalazzo.jpg'),
  'text' => 'Jeans Palazzo'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans baggy elegante.jpg'),
  'text' => 'Jean Baggy.'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans baggy.jpg'),
  'text' => 'Jeans Baggy Casual'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans bootcut.jpg'),
  'text' => 'Jeans Bootcut'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans cargo.jpg'),
  'text' => 'Jeans Cargo'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans embroidered.jpg'),
  'text' => 'Jeans Bordados'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans flare.jpg'),
  'text' => 'Jeans Bota Campana'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans highwaist bota ancha.jpg'),
  'text' => 'Jeans Cintura Alta Bota Ancha Casual'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans normal.jpg'),
  'text' => 'Jeans Regular'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans skinny.jpg'),
  'text' => 'Jeans Skinny'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans slim.jpg'),
  'text' => 'Jeans Slim Casual'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans harem rotos w.jpg'),
  'text' => 'Jeans Harem Casual'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans harem constranting w.jpg'),
  'text' => 'Jeans Harem Contrastantes'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans sueltos.jpg'),
  'text' => 'Jeans Relaxed'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans capri relaxed.jpg'),
  'text' => 'Jeans Capri'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans capri.jpg'),
  'text' => 'Jeans Capri Casual'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans skinny men.jpg'),
  'text' => 'Jeans Skinny Hombre'
  ],
  [
  'image' => asset('assets/images/catalogo/jeans harem m.jpg'),
  'text' => 'Jeans Harem Hombre'
  ],
  ];
@endphp
@foreach($items as $item)
    <div class="col-sm-6 col-md-6 col-lg-3 work-item">
        <div class="work-item-container">
            <div class="work--img"><img src="{{$item['image']}}"
                                        alt="{{$item['text']}}"/>
                <div class="work--hover">
                    <div class="work--action">
                        <div class="work--zoom"><a class="img-gallery-item"
                                                   href="{{$item['image']}}"
                                                   title="{{$item['text']}}"></a>
                        </div>
                        <div class="work--content">
                            <div class="work--title">
                                <h4>{{$item['text']}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach