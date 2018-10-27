package com.supinfo.model;

public class ConvertModel {

    private String fromFile;

    private String toFormat;

    private String mail;

    public ConvertModel() {
    }


    public ConvertModel(String fromFile, String toFormat,String mail) {
        this.fromFile = fromFile;
        this.toFormat = toFormat;
        this.mail = mail;
    }

    public String getToFormat() {
        return toFormat;
    }

    public void setToFormat(String toFormat) {
        this.toFormat = toFormat;
    }

    public String getFromFile() {
        return fromFile;
    }

    public void setFromFile(String fromFile) {
        this.fromFile = fromFile;
    }

    public String getMail() {
        return mail;
    }

    public void setMail(String mail) {
        this.mail = mail;
    }
}
