<?php

namespace TrackLab\Services;

use TrackLab\Models\Event,
    TrackLab\Models\People,
    TrackLab\Models\Project,
    TrackLab\Models\EntityModel,
    TrackLab\Models\AppException;

class QueryService extends ServiceBase
{

    /**
     * 
     * @param Project $project
     * @param type $query
     * @return array
     */
    public function queryEvents($type, Project $project, $query, $sort, $limit)
    {
        $collection = $this->getMongoCollection('event_' . $project->code);

        if ($type == 'query')
        {
            $data = $query ? $collection->find($query) : $collection->find();

            if ($sort)
                $data->sort($sort);

            $data->limit($limit);
        }

        if ($type == 'aggregate')
        {
            $data = $collection->aggregate($query);
            if (isset($data['result']))
                $data = $data['result'];
        }

        $res     = array();
        $columns = array();
        foreach ($data as $i => $r)
        {
            if ($type == 'query')
            {
                $r['id']    = $r["_id"]->{'$id'};
                $r['_date'] = date('Y-m-d H:i:s', (int) $r['_date']->sec);
                unset($r["_id"]);
                unset($r["peopleId"]);
            }



            if (is_array($r))
            {
                $res[] = $r;

                foreach ($r as $k => $v)
                {
                    if (!in_array($k, $columns))
                        $columns[] = $k;
                }
            }
            else
            {
                $res[]     = array($i => $r);
                if (!in_array($i, $columns))
                    $columns[] = $i;
            }
        }

        return array("items" => $res, "columns" => $columns);
    }

    /**
     * 
     * @param Project $project
     * @param type $query
     * @return array
     */
    public function queryPeople($type, Project $project, $query, $sort, $limit)
    {
        $collection = $this->getMongoCollection('people_' . $project->code);

        if ($type == 'query')
        {
            $data = $query ? $collection->find($query) : $collection->find();

            if ($sort)
                $data->sort($sort);

            $data->limit($limit);
        }

        if ($type == 'aggregate')
        {
            $data = $collection->aggregate($query);
            if (isset($data['result']))
                $data = $data['result'];
        }

        $res     = array();
        $columns = array();
        foreach ($data as $i => $r)
        {
            if ($type == 'query')
            {
                $r['id']    = $r["_id"]->{'$id'};
                $r['_date'] = date('Y-m-d H:i:s', (int) $r['_date']->sec);
                unset($r["_id"]);
                unset($r["peopleId"]);
            }



            if (is_array($r))
            {
                $res[] = $r;

                foreach ($r as $k => $v)
                {
                    if (!in_array($k, $columns))
                        $columns[] = $k;
                }
            }
            else
            {
                $res[]     = array($i => $r);
                if (!in_array($i, $columns))
                    $columns[] = $i;
            }
        }

        return array("items" => $res, "columns" => $columns);
    }

}
