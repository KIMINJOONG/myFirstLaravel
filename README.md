# 라라벨 강좌를 들으며 라라벨의 기본을 공부해보자

-   서버실행 명령어 php artisan serve

## 폴더 구조

1. 라라벨에서 가장 중요한 폴더

-   app, routes, database를 주로 사용함

-   app 밑에 model, http아래에 controller가 존재
-   resources -> views 아래에 blade템플릿 즉 뷰가 존재함

## routes

-   해당 부분은 노드와 많이 비슷해서 빨리 이해가 된것같다 페이지 리턴은 views아래에 있는 파일로 해주면 됨 .blade는 생략

## blade템플릿이란?

-   라라벨에서 제공하는 기본적인 뷰 템플릿
-   web.php에서 view로 데이터를 포함시켜서 보낼때 3가지 방법이 있다.

```
1. 첫번째방법 :
return view('welcome')->with([
    'books' => $books
]);

2. 두번째 방법 :
return view('welcome', [
    'books' => $books
]);

3. 세번째 방법 :
return view('welcome')->withBooks($books);

```

-   보통은 첫번째를 주로 많이 쓰고 그다음 두번째를 쓴다 3번째는 잘 안쓴다고 한다.

## controller 분리

-   스프링이든 노드 express프레임웤을 이용하든 mvc패턴을 활용해 개발을 하다보면 컨트롤러를 분리해야한다. 한파일에 다 넣게되면 코드가 엄청나게 길어지니까
    라라벨에서 컨트롤러 분리하는법을 알아봅시다.
-   php artisan make:controller 컨트롤러이름 ex) php artisan make:controller HomeController

```
HoemController

class HomeController extends Controller
{
    public function index() {
            $books = [
                'Harry Potter',
                'Laravel'
            ];
            return view('welcome', [
                'books' => $books
            ]);
            // return view('welcome')->with([
            //     'books' => $books
            // ]);
            // return view('welcome')->withBooks($books);
    }
}

web.php

Route::get('/', 'HomeController@index'); -> HomeController.php안에 함수이름이 index인 함수를 실행해라

```

## db연결과 마이그레이션

-   database > migrations안에는 테이블 구조들이 정의되어있다. 새롭게 정의하고싶다면 기존의 파일을 참고하여 만들면 된다.

1. php artisan migrate -> 쿼리구문실행 테이블이 생성됨
   php artisan migrate:rollback -> 생성한 테이블 전부 제거됨
   php artisan migrate:fresh -> 데이터베이스를 다 밀고 다시 실행한다는 뜻

2) 테이블 생성 구문 php artisan make:migration create_projects_table

-   테이블명은 복수형으로 써주는게 컨벤션

php artisan make:model Project

## tailwind설치

-   npm을 사용하여 tailwindcss를 install해주고 공식문서에 설치가이드를 따라해주면된다. webpack.mix.js에서 추가해주는거 꼭 해주기
-   그후 npm run dev명령어를 이용하면 webpack.mix.js에 설정되있는 파일들을 컴파일해준다

---

-   php artisan make:model 모델명 -c -m 이렇게 하면 라라벨에서 추천하는 방식으로 모델과 컨트롤러 마이그레이션을 할 수 있습니다.

## 동적 url

-   node에서는 /tasks/:id 였지만 라라벨은 아래와 같다.

```
Route::get('/tasks/{task}', 'TaskController@show');
```

-   컨트롤러 함수에서 $task만 사용하면 param값이 나오는데, 앞에 Task 즉 모델명을 붙여주면 라라벨에서 인식을하여 해당 $task값을 가지고있는 db값 전체를 가져옴

```
TaskController

public function show(Task $task) {
        return view('tasks.show', [
            'task'=> $task
        ]);
    }
```

---

## php artisan tinker?

-   play gorund환경이 실행됨. App\Task::all같은 함수들을 실행시 결과를 터미널에서 바로 볼 수 있다.

---

## 서버에서 validation

-   아래와 같이 해주면 title과 body값이 존재하지 않을시 에러를 리턴해줌

```

request()->validate([
            'title' => 'required',
            'body' => 'required'
]);
```

-   리턴해준 에러는 어떻게 해야할까?

```
.blade.php에서

@if($errors->any())
            {{ $errors }}
@endif

아래 구문을 넣고 에러를 발생시켜보면 리턴되는것을 알 수 있습니다.
특정에러에 대한 메세지만 보여주고싶다면 다음과 같이 하면 됩니다.

@error('body')
    <small class="text-red-700">{{ $message }}</small>
@enderror

혹은 html태그 클래스 안에 아래와 같이 추가하여 에러 발생시 보더 색을 변경한다던지 특정 css를 입힐수있습니다. 아래는 body라는 값이 없어서 서버에서 에러를 리턴하였을때
border색을 빨간색으로 변경시켜주게 만든 예시입니다.
<input class="border border-gray-800 w-full @error('body') border-red-700 @enderror" />

```

## 로그인

-   6부터 make:auth 가 대체되었습니다
    composer require laravel/ui
    php artisan ui vue --auth
    npm install
