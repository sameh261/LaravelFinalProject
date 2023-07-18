<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
@section('content')

    <div class="cont">
        <div class="container">
            <div class="image">
                <img src="{{ asset('images/login.jpg') }}" alt="Login Image">
            </div>
            <div class="form">
                <div class="fbs">
                <div class="facebook">
                    <a href="{{ route('login.facebook') }}">
                        <i class="fab fa-facebook"></i>
                    </a>
                </div>
            </div>
                <h2>Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password">
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="remember">
                        <label for="remember" class="rem">
                            <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember me
                        </label>
                    </div>
                    <button type="submit">Log in</button>
                    @if ($errors->any())
                        <span>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </span>
                    @endif
                    <div class="forget">
                        <a href="{{ route('password.request') }}" class="link">Forgot Password?</a>
                    </div>
                    <div class="haveAccount">
                        <p>Don't have an account?</p>
                        <a href="{{ route('register') }}" class="haveacc">Register Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style scoped>
        .cont {
            background-color: rgb(243, 243, 243);
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }


        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70vh;
            width: 60%;
            margin: 0 auto;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #333;
            font-weight: 500;
            text-align: start;
            margin-left: 7vh;
        }

        .image {
            width: 45%;
            height: 100%;
        }

        .image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px 0 0 8px;

        }

        form {
            background-color: white;

        }

        .form {
            border-radius: 0 8px 8px 0;
            width: 55%;
            height: 100%;
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;


        }

        .form h2 {
            margin-bottom: 1rem;
            background-color: white;

        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
            background-color: white;


        }

        input[type="text"],
        input[type="password"] {
            border: none;
            border-radius: 4px;
            padding: 1rem;
            font-size: 1rem;
            background-color: white;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 0.5rem;
            width: 80%;
            margin: 0 auto;
        }

        .remember {
            display: flex;
            justify-content: space-between;
            color: #e03ed7;
            width: 80%;
            margin: auto;
            margin-bottom: 1rem;

        }

        .remember label {
            display: flex;
            color: #e03ed7;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            width: 50%;
            text-align: start;
            align-items: center;

        }

        .rem input {
            justify-content: flex-start;
            accent-color: #e03ed7;

        }

        .forget {
            width: 80%;
            margin: auto;
            margin-bottom: 1rem;
            margin-top: 0.5rem;
            text-align: end;
        }

        .link {
            color: grey;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: end;
        }

        .link:hover {
            color: #e03ed7;
        }


        input:focus {
            border: #e03ed7 solid 1px !important;
        }

        button {
            border: none;
            border-radius: 4px;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            background-color: #e03ed7;
            color: #fff;
            cursor: pointer;
            width: 80%;
            height: 3rem;
            margin-top: 0.8rem;
        }

        button:hover {
            background-color: #c236bb;
        }

        span {
            color: red;
            font-size: 0.8rem;
            margin-top: 0.25rem;

        }

        .haveAccount {
            margin-top: 1rem;
            color: grey;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
        }

        .haveAccount a {
            text-decoration: none;
            color: #e03ed7;
        }

        .haveAccount a:hover {
            color: #e03ed7;
        }

        .fbs{
            display: flex;
            justify-content: end;
            margin-top: 1rem;
        }

        .facebook {
        display: flex;
        width: 2.5rem;
        height: 2.5rem;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        padding: 0.5rem;
        background-color: white;
        border: #c9c9c9be solid 1px;
        margin-right: 1rem;
        transition: all 0.2s ease-in-out;
    }

    .fa-facebook {
        font-size: 1.8rem;
        color: #b0b0b0be;
    }

    .facebook:hover {
        background-color: #4267B2;
        color: #4267B2;
        border: #4267B2 solid 1px;
    }





        @media screen and (max-width: 768px) {
            .container {
                flex-direction: column;
                height: 100%;
                width: 100%;
            }

            .image {
                width: 100%;
                height: 30%;
            }

            .form {
                width: 100%;
                height: 70%;
                border-radius: 8px;
            }

            .form h2 {
                margin-bottom: 1rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }

            .form-group label {
                margin-bottom: 0.5rem;
            }

            .form-group input {
                margin-bottom: 0.5rem;
            }

            .remember {
                margin-bottom: 1rem;
            }

            .link {
                text-align: start;
            }

            .haveAccount {
                margin-top: 1rem;
            }
        }
    </style>
