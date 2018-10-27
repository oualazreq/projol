package com.supinfo.controllers;

import com.supinfo.TranscodeApplication;
import com.supinfo.core.WorkerService;
import com.supinfo.model.PriceModel;
import com.supinfo.services.PriceService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.core.io.ClassPathResource;
import org.springframework.core.io.InputStreamResource;
import org.springframework.http.MediaType;
import org.springframework.http.ResponseEntity;
import org.springframework.util.FileCopyUtils;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

import javax.activation.MimetypesFileTypeMap;
import java.io.*;
import java.net.URI;
import java.net.URLConnection;

@RestController
@RequestMapping("/api/videos")
public class UploadsController {

    private int i;

    @Autowired
    @Qualifier(value="workerImpl")
    WorkerService workerService;

    @Autowired
    @Qualifier(value="priceServiceImpl")
    PriceService priceService;

    @RequestMapping(method = RequestMethod.POST)
    public Object handleFileUpload(
            @RequestParam("file") MultipartFile file) {

        String name = file.getName();
        System.out.println(file.getContentType());
        System.out.println(file.getName());
        System.out.println(file.getOriginalFilename());
        System.out.println(file.getSize());

        if (name.contains("/")) {

            return "Folder separators not allowed";
        }
        if (name.contains("/")) {
            //redirectAttributes.addFlashAttribute("message", "Relative pathnames not allowed");
            //return "redirect:/";
            return "Relative pathnames not allowed";
        }

        if (!file.isEmpty()) {
            URI uri = null;
            try {
                uri = new ClassPathResource("application.yaml").getURI();
            } catch (IOException e) {
                e.printStackTrace();
            }
            File fullPathToSubfolder = new File(uri).getAbsoluteFile();
            String projectFolder = fullPathToSubfolder.getAbsolutePath().split("target")[0];

            try {
                BufferedOutputStream stream = new BufferedOutputStream(
                        new FileOutputStream(new File(projectFolder+TranscodeApplication.ROOT + "/" + file.getOriginalFilename())));
                FileCopyUtils.copy(file.getInputStream(), stream);
                stream.close();



                Float price = priceService.computePrice(projectFolder+TranscodeApplication.ROOT + "/"+ file.getOriginalFilename());

                PriceModel priceModel = new PriceModel(price);

                return priceModel;
            }
            catch (Exception e) {
                e.printStackTrace();
                return "-1";
            }
        }
        else {
            return "0";
        }

    }


    @RequestMapping(path="/{clientId}/{fileName}/{format}",method = RequestMethod.GET)
    public ResponseEntity<InputStreamResource> getFile (
            @PathVariable String clientId,
            @PathVariable String fileName,
            @PathVariable String format) throws IOException {

        System.out.println(fileName);
        URI uri = null;
        try {
            uri = new ClassPathResource("application.yaml").getURI();
        } catch (IOException e) {
            e.printStackTrace();
        }
        File fullPathToSubfolder = new File(uri).getAbsoluteFile();
        String projectFolder = fullPathToSubfolder.getAbsolutePath().split("target")[0];

        FileInputStream file = new FileInputStream(projectFolder+TranscodeApplication.ROOT+"/"+clientId+"/conversions/"+fileName);

        File filee = new File(projectFolder+TranscodeApplication.ROOT+"/"+clientId+"/conversions/"+fileName);
        MimetypesFileTypeMap mimeTypesMap = new MimetypesFileTypeMap();

        String mimeType = mimeTypesMap.getContentType(filee);

        return ResponseEntity
                .ok()
                .contentLength(file.getChannel().size())
                .contentType(
                        MediaType.parseMediaType(mimeType))
                .body(new InputStreamResource(file));

    }

}
