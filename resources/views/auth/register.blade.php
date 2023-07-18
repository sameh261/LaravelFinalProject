<div class="cont">
    <div class="container-register">
        <div class="image-register">
            <img src="../images/login.jpg" alt="Register Image" />
        </div>
        <div class="form-register">
            <h2>Create an Account</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" placeholder="First Name" name="first_name"
                        value="{{ old('first_name') }}" required autofocus />
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" placeholder="Last Name" name="last_name"
                        value="{{ old('last_name') }}" required />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="Email" name="email" value="{{ old('email') }}"
                        required />
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Password" name="password" required />
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" placeholder="Confirm Password"
                        name="password_confirmation" required />
                </div>
                <button type="submit">Submit</button>
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

    .container-register {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 85vh;
      width: 60%;
      margin: 0 auto;
    }

    .image-register {
      width: 45%;
      height: 100%;
    }

    .image-register img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px 0 0 8px;
    }

    .form-register {
      border-radius: 0 8px 8px 0;
      width: 60%;
      height: 100%;
      background-color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
    }

    .form-register h2 {
      margin-bottom: 1rem;
    }

    label {
      margin-bottom: 0.5rem;
      text-align: start;
      margin-left: 7vh;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 0.5rem;
    }

    input[type="text"],
    input[type="password"] {
      border: none;
      border-radius: 4px;
      padding: 1rem;
      font-size: rem;
      background-color: white;
      box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
      width: 80%;
      margin: auto;
      margin-bottom: 0.5rem;

    }

    input:focus {
      border: #e03ed7 solid 1px !important;
    }

    button {
      border: none;
      border-radius: 4px;
      padding: 1rem 3rem;
      font-size: 1rem;
      background-color: #e03ed7;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
    }

    button:hover {
      background-color: #c02db5;
    }

    button:active {
      background-color: #a01c93;
    }

    span {
      color: red;
      font-size: 0.8rem;
      margin-top: 0.25rem;
    }

    @media screen and (max-width: 768px) {
      .container-register {
        flex-direction: column;
        height: 100%;
        width: 100%;
      }

      .image-register {
        width: 100%;
        height: 40%;
      }

      .form-register {
        width: 100%;
        height: 60%;
        border-radius: 8px;
      }

      .form-register h2 {
        margin-bottom: 1rem;
      }

      label {
        margin-bottom: 0.5rem;
        text-align: start;
        margin-left: 7vh;
      }

      .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 0.5rem;
      }

      input[type="text"],
      input[type="password"] {
        border: none;
        border-radius: 4px;
        padding: 1rem;
        font-size: 1rem;
        background-color: white;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin: auto;
        margin-bottom: 0.5rem;
      }

      input:focus {
        border: #e03ed7 solid 1px !important;
      }

      button {
        border: none;
        border-radius: 4px;
        padding: 1rem 3rem;
        font-size: 1rem;
        background-color: #e03ed7;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
      }

      button:hover {
        background-color: #c02db5;
      }

      button:active {
        background-color: #a01c93;
      }

      span {
        color: red;
        font-size: 0.8rem;
        margin-top: 0.25rem;
      }
    }

    @media screen and (max-width: 480px) {
      .container-register {
        flex-direction: column;
        height: 100%;
        width: 100%;
      }

      .image-register {
        width: 100%;
        height: 40%;
      }

      .form-register {
        width: 100%;
        height: 60%;
        border-radius: 8px;
      }

      .form-register h2 {
        margin-bottom: 1rem;
      }

      label {
        margin-bottom: 0.5rem;
        text-align: start;
        margin-left: 7vh;
      }

      .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 0.5rem;
      }

      input[type="text"],
      input[type="password"] {
        border: none;
        border-radius: 4px;
        padding: 1rem;
        font-size: 1rem;
        background-color: white;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        width: 80%;
        margin: auto;
        margin-bottom: 0.5rem;
      }

      input:focus {
        border: #e03ed7 solid 1px !important;
      }

      button {
        border: none;
        border-radius: 4px;
        padding: 1rem 3rem;
        font-size: 1rem;
        background-color: #e03ed7;
        color: white;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
      }

      button:hover {
        background-color: #c02db5;
      }

      button:active {
        background-color: #a01c93;
      }

      span {
        color: red;
        font-size: 0.8rem;
        margin-top: 0.25rem;
      }
    }
    </style>
