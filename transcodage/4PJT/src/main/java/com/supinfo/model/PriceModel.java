package com.supinfo.model;


public class PriceModel {

    private Float price;

    public PriceModel(Float price) {
        this.price = price;
    }

    public PriceModel() {
    }

    public Float getPrice() {
        return price;
    }

    public void setPrice(Float price) {
        this.price = price;
    }
}
