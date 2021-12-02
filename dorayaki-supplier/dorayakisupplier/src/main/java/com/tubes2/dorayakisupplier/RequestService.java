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
public class RequestService {
    @WebMethod
    public String sendRequest(@WebParam(name="nama_dorayaki") String nama_dorayaki, @WebParam(name="jumlah_stok")String jumlah_stok,@WebParam(name="ip") String ip, @WebParam(name="endpoint") String endpoint) throws IOException{
        //terima parameter request dari php client (checked)
        //kirim request ke backend buat count tabel logrequest (checked)
        //if < 10 request per menit then
        //  kirim parameter create request ke endpoint backend + kirim email + kasih feedback ke php client
        //  kirim similar parameter ke create logrequest endpoint backend
        String responseCountLogRequest = "";
        //String jumlah_stok_request = Integer.toString(jumlah_stok);
        int countLogRequest = 0;
        
        HttpGet request = new HttpGet("http://localhost:8080/log_request/");
        
        List<NameValuePair> urlParameters = new ArrayList<>();
        urlParameters.add(new BasicNameValuePair("ip", ip));
        urlParameters.add(new BasicNameValuePair("endpoint", endpoint));
        
        request.addHeader("ip", ip);
        request.addHeader("endpoint", endpoint);

        
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
            HttpPost postRequest = new HttpPost("http://localhost:8080/request/");
            HttpPost postLogRequest = new HttpPost("http://localhost:8080/log_request/");
            //create params for request
            List<NameValuePair> urlParametersRequest = new ArrayList<>();
            urlParametersRequest.add(new BasicNameValuePair("nama_dorayaki", nama_dorayaki));
            urlParametersRequest.add(new BasicNameValuePair("jumlah_stok", jumlah_stok));
            //params for log request
            List<NameValuePair> urlParametersLogRequest = new ArrayList<>();
            urlParametersLogRequest.add(new BasicNameValuePair("ip", ip));
            urlParametersLogRequest.add(new BasicNameValuePair("endpoint", endpoint));
            //bind params to post method
            postRequest.setEntity(new UrlEncodedFormEntity(urlParametersRequest));
            postLogRequest.setEntity(new UrlEncodedFormEntity(urlParametersLogRequest));
            //excute the method
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
                CloseableHttpResponse response = httpClient.execute(postLogRequest)) {
                
                System.out.println(EntityUtils.toString(response.getEntity()));
            }
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
                CloseableHttpResponse response = httpClient.execute(postRequest)) {
                
                System.out.println(EntityUtils.toString(response.getEntity()));
                if (response.getStatusLine().getStatusCode() != 200){
                    return "Request anda gagal dikirim karena dorayaki sudah tidak diproduksi pabrik!";
                }
            }
            
            return "Request anda berhasil dikirim";
        }
        else{ //rate limiter log request
            return "Request anda gagal dikirim karena melebihi rate limit";
        }
    };
    
    @WebMethod
    public String checkRequest(@WebParam(name="ip") String ip) throws IOException{
        //terima parameter request dari php client (checked)
        //kirim request ke backend buat count tabel logrequest (checked)
        //if < 10 request per menit then
        //  kirim parameter create request ke endpoint backend + kirim email + kasih feedback ke php client
        //  kirim similar parameter ke create logrequest endpoint backend
        String responseCountLogRequest = "";
        //String jumlah_stok_request = Integer.toString(jumlah_stok);
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
            HttpGet getCheck = new HttpGet("http://localhost:8080/request/check");
            HttpPost postLogRequest = new HttpPost("http://localhost:8080/log_request/");
            //params for log request
            List<NameValuePair> urlParametersLogRequest = new ArrayList<>();
            urlParametersLogRequest.add(new BasicNameValuePair("ip", ip));
            urlParametersLogRequest.add(new BasicNameValuePair("endpoint", "request/check"));
            postLogRequest.setEntity(new UrlEncodedFormEntity(urlParametersLogRequest));
            //excute the method
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
                CloseableHttpResponse response = httpClient.execute(postLogRequest)) {
                
                System.out.println(EntityUtils.toString(response.getEntity()));
            }
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
             CloseableHttpResponse response = httpClient.execute(getCheck)) {
                
                HttpEntity entity = response.getEntity();
                String result = EntityUtils.toString(entity);
                System.out.println(result);
                return result;
            }
        }
        else{ //rate limiter log request
            return "Request anda gagal dikirim";
        }
    }

    @WebMethod
    public String updateRequest(@WebParam(name="ip") String ip) throws IOException{
        String result = "";
        String responseCountLogRequest = "";
        int countLogRequest = 0;
        
        HttpGet request = new HttpGet("http://localhost:8080/log_request/");
        request.addHeader("ip", ip);
        request.addHeader("endpoint", "request/update");

        
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
            HttpGet updateRequest = new HttpGet("http://localhost:8080/request/update");
            HttpPost postLogRequest = new HttpPost("http://localhost:8080/log_request/");
            //params for log request
            List<NameValuePair> urlParametersLogRequest = new ArrayList<>();
            urlParametersLogRequest.add(new BasicNameValuePair("ip", ip));
            urlParametersLogRequest.add(new BasicNameValuePair("endpoint", "request/update"));
            postLogRequest.setEntity(new UrlEncodedFormEntity(urlParametersLogRequest));

            //excute the method
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
                CloseableHttpResponse response = httpClient.execute(postLogRequest)) {
                
                System.out.println(EntityUtils.toString(response.getEntity()));
            }
            try (CloseableHttpClient httpClient = HttpClients.createDefault();
            CloseableHttpResponse response = httpClient.execute(updateRequest)) {
                System.out.println(EntityUtils.toString(response.getEntity()));
                if (response.getStatusLine().getStatusCode() != 200){
                    return "Request anda gagal";
                }
                else{
                    return "";
                }
            }
        }
        else{ //rate limiter log request
            return "Request anda gagal dikirim karena melebihi rate limit";
        }
    }
}
