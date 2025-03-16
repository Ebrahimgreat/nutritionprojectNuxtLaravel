import { Prisma,PrismaClient } from "@prisma/client";
const prisma=new PrismaClient()
export default defineEventHandler(async(event)=>{
    try{
        const body=await readBody(event);
        if(!body.scaleWeight || !body.user_id){
            return{error:'Missing fields'}
        }
        const count=await prisma.weight.count({
            where:{
                user_id:body.user_id
            }
        });
        if(count<10)
        {
            const trendWeight=body.scaleWeight
            const reponse=await prisma.weight.create({
                data:{
                    scaleWeight:body.scaleWeight,
                    user_id:body.user_id,
                    trexndWeight:trendWeight

                }
            })

        }
    }
       
    
    catch(error)
    {
        console.log(error)
    }
    
})
