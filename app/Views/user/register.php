<!--React framework-->
<div class="container">
    <h1 class="ps-2">Register</h1>
    <div id="root" class="container">
    </div>
</div>

<!-- Start of Javascript -->
<script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src= "https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

<script type="text/babel">
    class ValidationForm extends React.Component {
        constructor(props) {
            super(props);
            this.state = {
                name: '',
                number: '',
                email: '',
                password: '',
                password_confirm: '',
                nameError: '',
                numberError: '',
                emailError: '',
                passwordError: '',
                password_confirmError: ''
            };
        }

        /* Handle methods */
        handleNameChange = event => {
            this.setState({name: event.target.value}, () => {
                this.validateName();
            });
        };

        handleNumberChange = event => {
            this.setState({number: event.target.value}, () => {
                this.validateNumber();
            });
        };

        handleEmailChange = event => {
            this.setState({email: event.target.value}, () => {
                this.validateEmail();
            });
        }

        handlePasswordChange = event => {
            this.setState({password: event.target.value}, () => {
                this.validatePassword();
            });
        };
        handlePasswordConfChange = event => {
            this.setState({password_confirm: event.target.value}, () => {
                this.validatePassword_confirm();
            });
        };

        /* Validations */
        validateName = () => {
            const {name} = this.state;
            if (name.length < 1) {
                this.setState({
                    nameError: 'First name must be at least 1 character.'
                });
            } else {
                this.setState({
                    nameError: ''
                });
            }
        }

        validateNumber = () => {
            const {number} = this.state;
            if (number.length < 10) {
                this.setState({
                    numberError: 'Number must be 10 digits'
                });
            } else if (number.length > 10) {
                this.setState({
                    numberError: 'Number must be 10 digits'
                });
            } else if (isNaN(number)) {
                this.setState({
                    numberError: 'Phone must be numeric.'
                });
            } else {
                this.setState({
                    numberError: ''
                });
            }
        }

        validateEmail = () => {
            const {email} = this.state;
            if (/[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,64}/.test(email)) {
                this.setState({
                    emailError: ''
                });
            } else {
                this.setState({
                    emailError: 'Email address is not a valid email address.'
                });
            }
        }

        validatePassword = () => {
            const {password} = this.state;
            if (password.length < 3) {
                this.setState({
                    passwordError: 'Your password must be at least 8 characters.'
                });
            } else {
                this.setState({
                    passwordError: ''
                });
            }
        }

        validatePassword_confirm = () => {
            const {password_confirm} = this.state;
            if (!(password_confirm === this.state.password)) {
                this.setState({
                    password_confirmError: 'Your passwords must match.'
                });
            } else if (password_confirm.length < 3 ){
                this.setState({
                    password_confirmError: 'Your password must be at least 8 characters.'
                });
            }else {
                this.setState({
                    password_confirmError: ''
                });
            }
        }


        handleSubmit = event => {
        };

        /*Rendering the actual form with validation */
        render() {
            return (
                <form onSubmit={this.handleSubmit} method="POST">
                    <div className="form-group">
                        <label for="name" className="form-label">Name</label>
                        <?php if(isset($validation)): ?>
                        <div class="text-danger">
                            *<?= $validation->getError('name') ?>
                        </div>
                        <?php endif;?>
                        <input type="text" className="form-control" name="name" id="uName" value={this.state.name} onChange={this.handleNameChange} />
                        <div style={{color: "red"}}>{this.state.nameError}</div>
                    </div>
                    <div className="form-group">
                        <label for="number" className="form-label">Number</label>
                        <?php if(isset($validation)): ?>
                        <div class="text-danger">
                            *<?= $validation->getError('number') ?>
                        </div>
                        <?php endif;?>
                        <input type="text" className="form-control" name="number" id="uNumber" value={this.state.number} onChange={this.handleNumberChange} />
                        <div style={{color: "red"}}>{this.state.numberError}</div>
                    </div>
                    <div className="form-group">
                        <label for="email" className="form-label">E-mail</label>
                        <?php if(isset($validation)): ?>
                        <div class="text-danger">
                            *<?= $validation->getError('email') ?>
                        </div>
                        <?php endif;?>
                        <input type="text" className="form-control" name="email" id="uEmail" value={this.state.email} onChange={this.handleEmailChange} />
                        <div style={{color: "red"}}>{this.state.emailError}</div>
                    </div>
                    <div className="form-group">
                        <label for="password" className="form-label">Password</label>
                        <?php if(isset($validation)): ?>
                        <div class="text-danger">
                            *<?= $validation->getError('password') ?>
                        </div>
                        <?php endif;?>
                        <input type="password" className="form-control" name="password" id="password" value={this.state.password} onChange={this.handlePasswordChange} />
                        <div style={{color: "red"}}>{this.state.passwordError}</div>
                    </div>
                    <div className="form-group">
                        <label for="password_confirm" className="form-label">Confirm Password</label>
                        <?php if(isset($validation)): ?>
                        <div class="text-danger">
                            *<?= $validation->getError('password_confirm') ?>
                        </div>
                        <?php endif;?>
                        <input type="password" className="form-control" name="password_confirm" id="password_confirm" value={this.state.password_confirm} onChange={this.handlePasswordConfChange} />
                        <div style={{color: "red"}}>{this.state.password_confirmError}</div>
                    </div>
                    <div className="form-group">
                        <button type="submit" className="btn btn-primary">Register</button>
                    </div>
                </form>
            );
        }
    }



    ReactDOM.render(
        <ValidationForm />,
        document.getElementById('root')
    );


</script>

