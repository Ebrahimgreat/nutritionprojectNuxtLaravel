import { Prisma, PrismaClient } from "@prisma/client";
const prisma=new PrismaClient()
export default defineEventHandler(async (event) => {
    try {
      let data=await $fetch('http://127.0.0.1:8000/api/nutrients',{
        method:'GET'
      })
      return data;
      
    }

    catch(error)
    {
      console.log(error)
    }
  });