package com.supinfo.controllers;

import com.stripe.Stripe;
import com.stripe.exception.*;
import com.stripe.model.Charge;
import com.supinfo.model.Payment;
import com.supinfo.model.PriceModel;
import com.supinfo.model.User;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;

import java.net.URISyntaxException;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

@RestController
@RequestMapping("/api/payment")

public class PaiementController {


    @RequestMapping(method = RequestMethod.POST)
    public List<String> chargeUser(@RequestBody Payment payment){


        Stripe.apiKey = "sk_test_";



        try {
            Map<String, Object> chargeParams = new HashMap<String, Object>();
            chargeParams.put("amount", payment.getAmount()); 

            chargeParams.put("currency", "eur");
            chargeParams.put("source", payment.getToken());
            chargeParams.put("description", "Example charge");

            Charge.create(chargeParams);
        } catch (CardException e) {
            
        } catch (APIException e) {
            e.printStackTrace();
        } catch (InvalidRequestException e) {
            e.printStackTrace();
        } catch (APIConnectionException e) {
            e.printStackTrace();
        } catch (AuthenticationException e) {
            e.printStackTrace();
        }

        String[] formats = {"mp4","mp3","avi"};
        return Arrays.asList(formats);

    }

    @RequestMapping(path="/api/price", method = RequestMethod.GET)
    public PriceModel add() {

        PriceModel result = new PriceModel();
        result.setPrice(150f);

        return result;
    }
}
