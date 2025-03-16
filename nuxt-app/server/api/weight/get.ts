import { Prisma, PrismaClient } from "@prisma/client"
const prisma=new PrismaClient()
export default defineEventHandler(async(event)=>{
    try{
        return await prisma.weight.findMany();
    }
    catch(error)
    {
        console.log(error)
    }

})