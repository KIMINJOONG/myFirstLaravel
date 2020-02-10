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
