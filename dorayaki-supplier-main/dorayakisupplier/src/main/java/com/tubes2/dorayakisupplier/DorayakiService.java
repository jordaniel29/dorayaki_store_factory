/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.tubes2.dorayakisupplier;
import javax.jws.*;
import org.apache.http.Header;
import org.apache.http.HttpEntity;
import org.apache.http.HttpHeaders;
import org.apache.http.NameValuePair;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import org.json.*;
/**
 *
 * @author Hizki
 */
@WebService
public class DorayakiService {
    @WebMethod
    public String getAllDorayaki(@WebParam(name="ip") String ip) throws IOException{
        String result = "";
        String responseCountLogRequest = "";
        int countLogRequest = 0;
        
        HttpGet request = new HttpGet("http://localhost:8080/log_request/");
        request.addHeader("ip", ip);
        request.addHeader("endpoint", "request/check");

        
        try (CloseableHttpClient httpClient = HttpClients.createDefault();
             CloseableHttpResponse responseLogRequest = httpClient.execute(request)) {

            HttpEntity entity = responseLogRequest.getEntity();
            if (entity != null) {
                // return it as a String
                responseCountLogRequest = EntityUtils.toString(entity);
                JSONArray arr = new JSONArray(responseCountLogRequest);
                JSONObject rec = arr.getJSONObject(0); //it only contains 1 object
                countLogRequest = rec.getInt("COUNT(*)");
            }
        }

        if(countLogRequest < 10){ //count table log request < 10 req per menit udah di confirm di backend juga
            //httpPost create request
            //httpPost create request
            HttpGet getDorayaki = new HttpGet("http://localhost:8080/resep/dorayaki");
            HttpPost postLogRequest = new HttpPost("http://localhost:8080/log_request/");
            //params for log request
            List<NameValuePair> urlParametersLogRequest = new ArrayList<>();
            urlParametersLogRequest.add(new BasicNameValuePair("ip", ip));
            urlParametersLogRequest.add(new BasicNameValuePair("endpoint", "resep/dorayaki"));
            postLogRequest.setEntity(new UrlEncodedFormEntity(urlParametersLogRequest));
            //excute the method
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
                CloseableHttpResponse response = httpClient.execute(postLogRequest)) {
                
                System.out.println(EntityUtils.toString(response.getEntity()));
            }
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
                CloseableHttpResponse response = httpClient.execute(getDorayaki)) {

                HttpEntity entity = response.getEntity();
                if (entity != null) {
                   // return it as a String
                   result = EntityUtils.toString(entity);
                   System.out.println(result);
               }

            }
            return result;
        }
        else{ //rate limiter log request
            return "Request anda gagal dikirim karena melebihi rate limit";
        }
    }
}
