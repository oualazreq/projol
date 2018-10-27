package com.supinfo.repository;

import com.supinfo.model.ConvertedVideo;
import com.supinfo.model.User;

import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface ConvertedVideoRepo extends CrudRepository<ConvertedVideo, Long> {

    List<ConvertedVideo> findByUser(User user);
}
