@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="d-inline text-light py-2 px-3 bg-primary" style="border-radius: 50px;">Score : <span
                        id="score">0</span></div>
            </div>
            <div class="col-4 d-flex justify-content-center">
                Question : <span id="q-number">1</span> / 10
            </div>
            <div class="col-4 d-flex justify-content-end">
                <div class="d-inline text-light py-2 px-3 bg-primary" style="border-radius: 50px;">
                    <i class="bi bi-alarm"></i> :
                    <span id="countdown">0</span>
                </div>
            </div>
        </div>

        <div class="card p-3 mt-5" id="q-box">
            <h4 id="question">Q1. Question</h4>
            <form class="d-flex flex-column" style="gap: 15px;" action="" method="post" id="form">
                @csrf
                <input type="hidden" name="qId">
                <div class="w-100 text-start btn btn-outline-primary">A. </div>
                <div class="w-100 text-start btn btn-outline-primary">B. </div>
                <div class="w-100 text-start btn btn-outline-primary">C. </div>
                <div class="w-100 text-start btn btn-outline-primary">D. </div>
            </form>
        </div>

        <div class="mt-5">
            <x-app-button type='submit'>Next Question</x-app-button>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('#q-box #form div').click(function() {
            $('#q-box #form div').removeClass('btn-primary');
            $(this).addClass('btn-primary');
        });

        $('button[type="submit"]').click(function() {
            $('#q-box #form').submit();
        });

        const questions = [
            @foreach ($questions as $question)
                {
                    'id': "{{ $question->id }}",
                    'question': "{{ $question->question }}",
                    'a': "{{ $question->a }}",
                    'b': "{{ $question->b }}",
                    'c': "{{ $question->c }}",
                    'd': "{{ $question->d }}",
                },
            @endforeach
        ];

        var currentQuestion = 0;
        var countdown = 16;
        var score = 0;
        var countdownInterval = null;

        function next() {
            if(currentQuestion > 10) window.location.href = `{{ route('game.result', ['gameId' => $gameId, 'sectorId' => $sectorId]) }}?score=${score}`;
            currentQuestion++;
            console.log($('#form .btn-primary').attr('class'));
            $('#form .btn-primary').removeClass('btn-primary');
            $('#q-number').text(currentQuestion);
            $('#score').text(score);
            const question = questions[currentQuestion - 1];
            $('#question').text(`Q${currentQuestion} : ${question.question}`);
            $('#form div').each((index, div) => {
                switch (index) {
                    case 0:
                        $(div).text(`A. ${question.a}`);
                        $(div).attr('data-answer', question.a);
                        break;
                    case 1:
                        $(div).text(`B. ${question.b}`);
                        $(div).attr('data-answer', question.b);

                        break;
                    case 2:
                        $(div).text(`C. ${question.c}`);
                        $(div).attr('data-answer', question.c);

                        break;
                    case 3:
                        $(div).text(`D. ${question.d}`);
                        $(div).attr('data-answer', question.d);

                        break;

                    default:
                        break;
                }
            });
            $('#form input[name="qId"]').val(question.id);


            countdown = 16;
            clearInterval(countdownInterval);
            countdownInterval = setInterval(() => {
                countdown--;
                if (countdown >= 0) {
                    $('#countdown').text(countdown);
                } else {
                    console.log('called');
                    $('#q-box #form').submit();
                }
            }, 1000);
        }
        next();

        $('#q-box #form').on('submit', function(e) {
            e.preventDefault();
            console.log('first');
            $.ajax({
                url: `{{ route('sectors.submit.submit', ['gameId' => $gameId, 'sectorId' => $sectorId]) }}`,
                method: 'POST',
                data: {
                    '_token': $('input[name="_token"]').val(),
                    answer: $('#form .btn-primary').attr('data-answer') ?? '',
                    qId: $('#form input[name="qId"]').val(),
                },
                success: function() {
                    score++;
                },
                failure: function() {

                },
                complete: function() {
                    next();
                },
            })
        });
    </script>
@endpush
