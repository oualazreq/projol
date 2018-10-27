package com.supinfo.repository;

import com.supinfo.model.User;
import com.supinfo.model.UserSpace;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface UserSpaceRepository extends CrudRepository<UserSpace, Long> {


}
