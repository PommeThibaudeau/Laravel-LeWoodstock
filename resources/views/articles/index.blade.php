@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="my-4 index__title">Les créations</h1>

        <div class="index__filterbar">
            {{ Form::model($article, ['class' => ' index__filterbar__form', 'method' => 'POST', 'route' => ['articles.index']]) }}

                {{ Form::text("search", $search_filter, ['class' => 'form-control mx-1 index__filterbar__form__item', 'placeholder' => 'Rechercher']) }}
                {{ Form::select("type", $types, $type_filter, ['class' => 'chosen-select form-control mx-1 index__filterbar__form__item index__form__type', 'data-placeholder' => 'Choisissez un type']) }}
                {{ Form::select('matters[]', $matters, $matters_filter, ['class' => 'chosen-select form-control mx-1 index__filterbar__form__item index__form__matter', 'multiple' => 'multiple', 'data-placeholder' => 'Choisissez des matières']) }}

                <div class="no-wrap">
                    <!-- REFRESH BUTTON -->
                    <a href="{{ route('articles.index', ['reset' => 'true' ]) }}" class="btn btn-primary mx-1">
                        <i class="fas fa-sync-alt fa-lg"></i>
                    </a>

                    <!-- SEND FILTERS BUTTON -->
                    {{ Form::submit('Envoyer', ['class' => 'btn btn-primary mx-1 index__filterbar__form__item']) }}
                </div>

            {{ Form::close() }}



            @auth
                <a href="{{ route('articles.create') }}" class="push">
                    <span class="btn btn-outline-primary">Ajouter</span>
                </a>
            @endauth
        </div>

        <div class="row">
            @if(count($articles))
                @foreach ($articles as $article)
                    <div class="col-md-4 col-sm-6 index__item portfolio-item">
                        <div class="card h-100">
                            @if( $article->stock == 0)
                                <div class="index__item__soldout">
                                    <i class="fas fa-ban fa-lg"></i>
                                </div>
                            @endif
                            <div class="index__item__image">
                                <img class="card-img-top" data-src="{{ Storage::url($article->images[0]->src) }}" alt="{{ $article->images[0]->alt }}" src="{{ Storage::url($article->images[0]->src) }}" data-holder-rendered="true">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $article->designation }}</h4>
                                <p class="card-text">{{ $article->description }}</p>
                                @if( $article->stock > 0)
                                    <p>{{ $article->stock }}</p>
                                @endif
                                <p><span class="badge badge-warning">{{ $article->type->designation }}</span></p>
                                @foreach($article->matters()->get() as $matter)
                                    <span class="badge badge-secondary">{{ $matter->designation }}</span>
                                @endforeach

                                <br><br><br>

                                <div class="index__item__buttons">
                                    <div class="index__item__buttons--left">
                                        <a href="{{ route("articles.show",['id' => $article->getKey()]) }}" class="btn btn-outline-primary">
                                            En savoir plus
                                        </a>
                                    </div>

                                    @auth
                                        <div class="index__item__buttons--right">
                                            <a href="{{ route('articles.edit', ['id' => $article->getKey()]) }}">
                                                <i class="fas fa-edit fa-2x"></i>
                                            </a>
                                            <a href="{{ route('articles.delete', ['id' => $article->getKey()]) }}">
                                                <i class="fas fa-trash fa-2x"></i>
                                            </a>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>

                @if($page_number > 1)
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        @for($i = 1; $i<=$page_number; ++$i)
                            <li class="page-item">
                                <a class="page-link" href="{{ route('articles.index', ['page' => $i]) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endfor

                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                @endif
            @else
                <p>Aucun article actuellement</p>
            @endif

    </div>

@endsection

