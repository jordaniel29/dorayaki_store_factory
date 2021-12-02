package com.tubes2.dorayakisupplier;
import javax.xml.ws.*;

public class Exporter{
    public static void main(String[] args) {
        Endpoint.publish("http://localhost:1234/dorayaki", new DorayakiService());
        Endpoint.publish("http://localhost:1234/request", new RequestService());
        System.out.println("JAX-WS web service is running on port 1234");
    }
}