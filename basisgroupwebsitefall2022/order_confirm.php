<div class="insertform">
    <div>
        <?php
require_once('./backend_items.php');

if(!isset($_SESSION['shopping_cart']))
{
    header("Location: ./catalog_page.php?page_number=0");
}
if(!isset($_SESSION['account']))
{
    header("Location: ./loginpage.php");
}

for($i = 0; $i < count($_SESSION['shopping_cart']); $i++){
        $itemObject = new Item();
        $itemObject->selectItemObject($_SESSION['shopping_cart'][$i][0]);
        print("
            <form method='post'>
                <input type='hidden' id='item_id' name='item_id' value='" . $itemObject->getItemID() . "'>
                <input type='hidden' id='index' name='index' value='" . $i . "'>
                <img class='item_img' src='" . $itemObject->getPhoto() . "'/>
                <p> " . $itemObject->getName() . "</p>
                <p> $" . $itemObject->getPrice() . "</p>
                <p> Quantity: " . $_SESSION['shopping_cart'][$i][1] . "</p>
            </form>"
        );
    }
    print("
            <form action='submit_order.php' method='post'>
                <label for='country'>Country</label>
                <select name='country' id='country'>
                    <option>select country</option>
                </select>

                <label for='state'>State</label>
                <span id='state-code'><input type='text' id='state'></span>

                <label for='address'>Address</label>
                <input required type='text'  id='address' name='address' placeholder='address'/>

                <label for='city'>City</label>
                <input required type='text'  id='city' name='city' placeholder='city'/>

                <label for='zip'>ZIP Code</label>
                <input required type='text'  id='zip' name='zip' placeholder='ZIP code'/>

                <label for='payment_method'>Payment Method</label>
                <input required type='text'  id='payment_method' name='payment_method' placeholder='Payment Method'/>

                <input type='submit' value='Confirm Order'></input>
            </form>");
        ?>
    </div>
    </div>
<script src=".\country-states.js"></script><!-- adds country and states code list-->
<script>//script that implements country drop down from www.html-code-generator.com
    // user country code for selected option
    let user_country_code = "IN";

    (function () {
        // script https://www.html-code-generator.com/html/drop-down/country-region

        // Get the country name and state name from the imported script.
        let country_list = country_and_states['country'];
        let states_list = country_and_states['states'];

        // creating country name drop-down
        let option =  '';
        option += '<option>select country</option>';
        for(let country_code in country_list){
            // set selected option user country
            let selected = (country_code == user_country_code) ? ' selected' : '';
            option += '<option value="'+country_code+'"'+selected+'>'+country_list[country_code]+'</option>';
        }
        document.getElementById('country').innerHTML = option;

        // creating states name drop-down
        let text_box = '<input type="text" class="input-text" id="state">';
        let state_code_id = document.getElementById("state-code");

        function create_states_dropdown() {
            // get selected country code
            let country_code = document.getElementById("country").value;
            let states = states_list[country_code];
            // invalid country code or no states add textbox
            if(!states){
                state_code_id.innerHTML = text_box;
                return;
            }
            let option = '';
            if (states.length > 0) {
                option = '<select name="state" id="state">\n';
                for (let i = 0; i < states.length; i++) {
                    option += '<option value="'+states[i].code+'">'+states[i].name+'</option>';
                }
                option += '</select>';
            } else {
                // create input textbox if no states 
                option = text_box
            }
            state_code_id.innerHTML = option;
        }

        // country select change event
        const country_select = document.getElementById("country");
        country_select.addEventListener('change', create_states_dropdown);

        create_states_dropdown();
    })();

</script>