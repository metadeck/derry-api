Vue.component('stripe-payment', {

    template: `
    <div>
        <div class="form-group" :class="{'has-error': cardNumberError}">
            <label for="card_number" class="col-md-4 control-label">Card Number</label>
            <div class="col-md-6">
                <input id="card_number" v-model="card.number" type="text" class="form-control">
                <span class="help-block" v-show="cardNumberError">
                    {{ cardNumberError }}
                </span>
            </div>
        </div>

        <div class="form-group" :class="{'has-error': cardCvcError}">
            <label for="cvc" class="col-md-4 control-label">CVC</label>
            <div class="col-md-6">
                <input id="cvc" v-model="card.cvc" type="text" class="form-control">
                <span class="help-block" v-show="cardCvcError">
                    {{ cardCvcError }}
                </span>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group" :class="{'has-error': cardMonthError}">
                <label for="exp_month" class="col-md-4 control-label">Expiry Month</label>
                <div class="col-md-6">
                    <input id="exp_month" v-model="card.exp_month" type="text" class="form-control" placeholder="MM">
                    <span class="help-block" v-show="cardMonthError">
                        {{ cardMonthError }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group" :class="{'has-error': cardYearError}">
                <label for="exp_month" class="col-md-4 control-label">Expiry Year</label>
                <div class="col-md-6">
                    <input id="exp_year" v-model="card.exp_year" type="text" class="form-control" placeholder="YY">
                    <span class="help-block" v-show="cardYearError">
                        {{ cardYearError }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="form-group has-error" v-if="cardCheckError">
            <span>{{ cardCheckErrorMessage }}</span>
        </div> 

        <div class="form-group" v-if="!tokenRetrieved">
            <div class="col-md-6 col-lg-12">
                <button type="submit" class="button button-primary button-fullwidth button-form" @click.prevent="validate" :disabled="cardCheckSending">
                    <span v-if="cardCheckSending">
                        <i class="fa fa-btn fa-spinner fa-spin"></i> Validating Card
                    </span>
                    <span v-else>
                        Validate Card
                    </span>
                </button>
            </div>
        </div>
    </div>
    `,

    props: {
        stripeKey: {
            type: String,
            required: true
        }
    },

    data(){
        return {
            card: {
                number: null,
                cvc: null,
                exp_month: null,
                exp_year: null
            },
            cardNumberError: null,
            cardCvcError: null,
            cardMonthError: null,
            cardYearError: null,
            cardCheckSending: false,
            cardCheckError: false,
            cardCheckErrorMessage: '',
            tokenRetrieved: false
        }
    },

    methods: {

        validate(){
            this.clearCardErrors();
            let valid = true;
            if(!this.card.number){ valid = false; this.cardNumberError = "Card Number is Required"; }
            if(!this.card.cvc){ valid = false; this.cardCvcError = "CVC is Required"; }
            if(!this.card.exp_month){ valid = false; this.cardMonthError = "Month is Required"; }
            if(!this.card.exp_year){ valid = false; this.cardYearError = "Year is Required"; }
            if(valid){
                this.createToken();
            }
        },

        clearCardErrors(){
            this.cardNumberError = null;
            this.cardCvcError = null;
            this.cardMonthError = null;
            this.cardYearError = null;
        },

        createToken() {
            this.cardCheckError = false;
            window.Stripe.setPublishableKey(this.stripeKey);
            window.Stripe.createToken(this.card, $.proxy(this.stripeResponseHandler, this));
            this.cardCheckSending = true;
        },

        stripeResponseHandler(status, response) {
            this.cardCheckSending = false;
            if (response.error) {
                this.cardCheckErrorMessage = response.error.message;
                this.cardCheckError = true;
            } else {
                this.tokenRetrieved = true;
                this.$emit('paymentEntered', response.id);
            }
        }
    }
});
